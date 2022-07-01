<?php
/**
 * PHP Version 7.2
 * Mnt
 *
 * @category Controller
 * @package  Controllers\Mnt
 * @author   Grupo #1
 * @license  Comercial http://
 * @version  CVS:1.0.0
 * @link     http://url.com
 */
 namespace Controllers\Mnt;

// ---------------------------------------------------------------
// Sección de imports
// ---------------------------------------------------------------
use Controllers\PublicController;
use Dao\Mnt\Productos as DaoProductos;
use Views\Renderer;

/**
 * Productos
 *
 * @category Public
 * @package  Controllers\Mnt;
 * @author   Grupo #1
 * @license  MIT http://
 * @link     http://
 */
class Catalogo extends PublicController //Nos permite tener los controladores adecuados
//Recordemos que el PublicController nos obliga a usar el metodo run para devolver algun tipo de vista
{
    /**
     * Runs the controller
     *
     * @return void
     */

    private $PageTitle = "";
    private $Productos = array();
    private $Page = 0; //Comienzo de la pagina
    private $ProductLimit = 3; //Limite de cuantos productos mostramos por pagina.
    private $Start = 0; //Inicio de la paginacion
    private $Total = 0; //Total de productos
    private $PagesCount = 1; //Total de paginacion de los productos
    private $PageIndexes = array(); //Contra la paginacion

    private $Previous = 0;
    private $PreviousState = "";
    private $Next = 0;
    private $NextState = "";

    private $UsuarioBusqueda = ""; //Descripcion del producto (busqueda)
    private $UsuarioBusquedaByPrice = ""; //Busqueda por el precio (rango)

    public function run() :void
    {
        $this->Page = isset($_GET['PageIndex']) ? $_GET['PageIndex'] : 1;
        $this->Start = ($this->Page-1) * $this->ProductLimit;
        $this->UsuarioBusqueda = isset($_GET['UsuarioBusqueda']) ? $_GET['UsuarioBusqueda'] : "";
        $this->UsuarioBusquedaByPrice = isset($_GET['UsuarioBusquedaByPrice']) ? $_GET['UsuarioBusquedaByPrice']: "";
        //mandamos los parametros de busqueda descripcion y precio
        $this->_load($this->UsuarioBusqueda,$this->UsuarioBusquedaByPrice);

        $dataview = get_object_vars($this);

        $layout = "layout.view.tpl";

        if (\Utilities\Security::isLogged()) {
            $layout = "privatelayout.view.tpl";
            \Utilities\Nav::setNavContext();
        }

        \Views\Renderer::render("mnt/catalogo", $dataview, $layout);
    }

    private function _load($busqueda="", $busquedaByPrice="")
    {
        //Si estan vacias ambos mostrara todos los productos 
        if (empty($busqueda) && empty($busquedaByPrice)) {
            $this->PageTitle = "Todos los Productos";
            $_total = DaoProductos::getProductCount();
            $_data = DaoProductos::getProductosforPage($this->Start, $this->ProductLimit);
            $this->Total = intval($_total["Total"]);
        } else {
            //Si por precio es vacia buscamos por descripcion
            if (empty($busquedaByPrice)) {
                $this->PageTitle = "Resultados de la Búsqueda: ".$this->UsuarioBusqueda;
                $_total = DaoProductos::searchProductosClienteCount($this->UsuarioBusqueda);
                $_data = DaoProductos::searchProductosCliente($this->UsuarioBusqueda, $this->Start, $this->ProductLimit);
                $this->Total = intval($_total["Total"]);
            } else {
                // buscamos por precio guardamos en un arreglo separado por - para obtener ambos precios.
                $rangos = explode("-",$busquedaByPrice);
                $this->PageTitle = "Resultados de la Búsqueda por precio: ".$this->UsuarioBusquedaByPrice;
                $_total = DaoProductos::searchProductosByPriceCount($rangos[0],$rangos[1]);
                $_data = DaoProductos::searchProductosByPrice($rangos[0],$rangos[1], $this->Start, $this->ProductLimit);
                $this->Total = intval($_total[0]["Total"]);
            }
        }
        
       //Esto es para la paginacion y mostrarla ceil redondea al mayor entero.
        $this->PagesCount = ceil($this->Total/$this->ProductLimit);

        //recorremos los indices para la paginacion.
        if (empty($this->UsuarioBusqueda)) {
            for ($i=1; $i<=$this->PagesCount; $i++) {
                $this->PageIndexes[] = array("Index"=>$i, "Busqueda"=>"", "Estado"=> ($this->Page == $i) ? "active" : "");
            }
        } else {
            for ($i=1; $i<=$this->PagesCount; $i++) {
                $this->PageIndexes[] = array("Index"=>$i, "Busqueda"=>$this->UsuarioBusqueda, "Estado"=> ($this->Page == $i) ? "active" : "");
            }
        }

        //Previous y next los botones cada vez que se presiona incrementa uno y disminuye el otro.
        $this->Previous = $this->Page - 1;
        $this->Next = $this->Page + 1;
       
        //Descripcion maxima a mostrar en caracteres 
        $max_description_length = 50;
        
        //recorremos los datos que tenemos 
        // strlen contamos de caracteres que tiene la descripcion del producto.
        foreach ($_data as $key => $value) {
            //Offset->Devuelve el valor de un campo con el desplazamiento de la posición inicial por un número especificado de bytes.
            //strrpos -> Encuentra la posición de la última aparición de un substring en un string
            
            //si la descripcion es mayor a 50 mostrara solo 50 caracteres y agg ...
            if (strlen($_data[$key]["invPrdDsc"]) > $max_description_length) {
                $string = $value["invPrdDsc"];
                $offset = ($max_description_length - 3) - strlen($string);
                //subtraemos texto de la cadena.
                $_data[$key]["invPrdDsc"] = substr($string, 0, strrpos($string, ' ', $offset)) . '...';
            }

            //precio final sera el precio de venta por el 15% de impuesto lo podemos cambiar.
            $precioFinal = ($value["invPrdPrecioVenta"]) + ($value["invPrdPrecioVenta"] * 0.15);
            //Formato de numero y solo 2 decimales.
            $_data[$key]["invPrdPrecioVenta"] = number_format($precioFinal, 2);
        }

        if ($_data) {
            $this->Productos = $_data;
        }

        $this->_setViewData();
    }

    /**
     *  Deshabilitar botones al encontrarse de los limites de paginas.
     */
    private function _setViewData()
    {
        $this->NextState = ($this->Page==$this->PagesCount) ? "disabled" : "";
        $this->PreviousState = ($this->Page == 1) ? "disabled" : "";
    }
}
