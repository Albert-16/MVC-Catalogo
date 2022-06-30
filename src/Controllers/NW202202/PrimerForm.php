<?php
//Este sera un script que contendra una clase
namespace Controllers\NW202202; //namespace se usa para declarar las clases

use Controllers\PublicController;
use Views\Renderer;

//Declaracion de la clase / esta se declara con el nombre del archivo
class PrimerForm extends PublicController{//extends -> se usa para indicar a que clase va a heredar
    //Esta es una clase abstracta que nos obliga a utilizar la siguiente funcion
    public function run() :void//PublicController nos obliga a que exista la clase run
    {
        $viewData=array();
        $viewData["txtNombre"]="Fulanito";
        $viewData["txtApellido"]="d'Tal";
        if (isset($_POST["btnEnviar"])) {
            $viewData["txtNombre"] = $_POST["nombre"];
        }
        if ($this->isPostBack()) {/*el $this hace referencia a la instancia que se esta ejecutando de este controlador
            isPostBack es un metodo que nos devuelve si la ejucion de este controlador es de un metodo get, hace lo mismo que el metodo isset pero el isset es mejor*/
            $viewData["txtApellido"] = $_POST["apellido"];        
        }
        Renderer::render('nw202202/primerform',$viewData); //Clase que usa metodos estaticos-su codigo fuente se puede ver en views
    }
}

?>
