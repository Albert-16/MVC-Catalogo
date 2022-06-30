<?php

namespace Controllers\Client;

use Dao\Client\catalogo;

class CatalogoProductos extends \Controllers\PublicController
{
    private $PageTitle = "";
    private $Productos = array();
    private $Page = 0;
    private $ProductLimit = 8;
    private $Start = 0;
    private $Total = 0;
    private $PagesCount = 1;
    private $PageIndexes = array();

    private $Previous = 0;
    private $PreviousState = "";
    private $Next = 0;
    private $NextState = "";

    private $UsuarioBusqueda = "";

    public function run() :void
    {
        $this->Page = isset($_GET['PageIndex']) ? $_GET['PageIndex'] : 1;
        $this->Start = ($this->Page-1) * $this->ProductLimit;
        $this->UsuarioBusqueda = isset($_GET['UsuarioBusqueda']) ? $_GET['UsuarioBusqueda'] : "";
  
        $this->_load($this->UsuarioBusqueda);

        $dataview = get_object_vars($this);

        $layout = "layout.view.tpl";

        if(\Utilities\Security::isLogged())
        {
            $layout = "privatelayout.view.tpl";
            \Utilities\Nav::setNavContext();
        }

        \Views\Renderer::render("Client/catalogo", $dataview, $layout);
    }

    private function _load($busqueda="")
    {
        if(empty($busqueda))
        {
            $this->PageTitle = "Todos los Productos";
            $_total = \Dao\Client\Productos::getProductCount();
            $_data = \Dao\Client\Productos::getProductosforPage($this->Start, $this->ProductLimit);
        }
        else
        {
            $this->PageTitle = "Resultados de la Búsqueda: ".$this->UsuarioBusqueda;
            $_total = \Dao\Client\Productos::searchProductosClienteCount($this->UsuarioBusqueda);
            $_data = \Dao\Client\Productos::searchProductosCliente($this->UsuarioBusqueda, $this->Start, $this->ProductLimit);
        }

        $this->Total = intval($_total["Total"]);
        $this->PagesCount = ceil($this->Total/$this->ProductLimit);

        if(empty($this->UsuarioBusqueda))
        {
            for($i=1; $i<=$this->PagesCount; $i++)
            {
                $this->PageIndexes[] = array("Index"=>$i, "Busqueda"=>"", "Estado"=> ($this->Page == $i) ? "active" : "");
            }
        }
        else
        {
            for($i=1; $i<=$this->PagesCount; $i++)
            {
                $this->PageIndexes[] = array("Index"=>$i, "Busqueda"=>$this->UsuarioBusqueda, "Estado"=> ($this->Page == $i) ? "active" : "");
            }
        }

        $this->Previous = $this->Page - 1;
        $this->Next = $this->Page + 1;
       
        $max_description_length = 50;
        
        foreach($_data as $key => $value)
        {
            if(strlen($_data[$key]["ProdDescripcion"]) > $max_description_length)
            {
                $string = $value["ProdDescripcion"];
                $offset = ($max_description_length - 3) - strlen($string);
                $_data[$key]["ProdDescripcion"] = substr($string, 0, strrpos($string, ' ', $offset)) . '...';
            }

            $precioFinal = ($value["ProdPrecioVenta"]) + ($value["ProdPrecioVenta"] * 0.15); 
            $_data[$key]["ProdPrecioVenta"] = number_format($precioFinal, 2);
        }

        if ($_data) 
        {
            $this->Productos = $_data;
        }

        $this->_setViewData();
    }

    private function _setViewData()
    {
        $this->NextState = ($this->Page==$this->PagesCount) ? "disabled" : "";
        $this->PreviousState = ($this->Page == 1) ? "disabled" : "";
    }
}