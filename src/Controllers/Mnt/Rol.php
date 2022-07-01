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
use Views\Renderer;
use Utilities\Validators;
use Dao\Mnt\Roles;

/**
 * Producto
 *
 * @category Public
 * @package  Controllers\Mnt;
 * @author   Grupo #1
 * @license  MIT http://
 * @link     http://
 */
class Rol extends PublicController
{
    private $viewData = array();
    private $arrModeDesc = array();
    private $arrEstados = array();

    public function run():void
    {
        // code
        $this->init();
        // Cuando es método GET (se llama desde la lista)
        if (!$this->isPostBack()) {
            $this->procesarGet();
        }
        // Cuando es método POST (click en el botón)
        if ($this->isPostBack()) {
            $this->procesarPost();
        }
        // Ejecutar Siempre
        $this->processView();
        Renderer::render('mnt/rol', $this->viewData);
    }

    private function init()
    {
        $this->viewData = array();
        $this->viewData["mode"] = "";
        $this->viewData["mode_desc"] = "";
        $this->viewData["crsf_token"] = "";

        $this->viewData["rolescod"] = "";
        $this->viewData["error_rolescod"] = array();  

        $this->viewData["rolesdsc"] = "";
        $this->viewData["error_rolesdsc"] = array();    

        $this->viewData["rolesest"] = "";
        $this->viewData["rolesestArr"] = array();

        $this->viewData["btnEnviarText"] = "Guardar";

        $this->viewData["readonly"] = false;
        $this->viewData["showBtn"] = true;
      
        $this->arrModeDesc = array(
            "INS"=>"Nuevo Producto",
            "UPD"=>"Editando %s %s",
            "DSP"=>"Detalle de %s %s",
            "DEL"=>"Eliminado %s %s"
        );

        $this->arrEstados = array(
            array("value" => "ACT", "text" => "Activo"),
            array("value" => "INA", "text" => "Inactivo"),
        );

        $this->viewData["rolesestArr"] = $this->arrEstados;
    }

    private function procesarGet()
    {
        if (isset($_GET["mode"])) {
            $this->viewData["mode"] = $_GET["mode"];
            if (!isset($this->arrModeDesc[$this->viewData["mode"]])) {
                error_log('Error: (Rol) Mode solicitado no existe.');
                \Utilities\Site::redirectToWithMsg(
                    "index.php?page=mnt_roles",
                    "No se puede procesar su solicitud!"
                );
            }
        }
        if ($this->viewData["mode"] !== "INS" && isset($_GET["id"])) {
            $this->viewData["rolescod"] = $_GET["id"];
            $tmpRol = Roles::getById($this->viewData["rolescod"]);
            error_log(json_encode($tmpRol));
            \Utilities\ArrUtils::mergeFullArrayTo($tmpRol, $this->viewData);
        }
    }

    private function procesarPost()
    {
        // Validar la entrada de Datos
        //  Todos valor puede y sera usando en contra del sistema
        $hasErrors = false;
        \Utilities\ArrUtils::mergeArrayTo($_POST, $this->viewData);
        if (isset($_SESSION[$this->name . "crsf_token"])
            && $_SESSION[$this->name . "crsf_token"] !== $this->viewData["crsf_token"]
        ) {
            \Utilities\Site::redirectToWithMsg(
                "index.php?page=mnt_roles",
                "ERROR: Algo inesperado sucedió con la petición Intente de nuevo."
            );
        }

        if (Validators::IsEmpty($this->viewData["rolescod"])) {
            $this->viewData["error_rolescod"][]
                = "El código es requerido";
            $hasErrors = true;
        }
        if (Validators::IsEmpty($this->viewData["rolesdsc"])) {
            $this->viewData["error_rolesdsc"][]
                = "La descripcion es requerida";
            $hasErrors = true;
        }
        error_log(json_encode($this->viewData));
        // Ahora procedemos con las modificaciones al registro
        if (!$hasErrors) {
            $result = null;
            switch($this->viewData["mode"]) {
            case 'INS':
                $result = Roles::insert(
                    $this->viewData["rolescod"],
                    $this->viewData["rolesdsc"],
                    $this->viewData["rolesest"],
                );
                if ($result) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt_roles",
                            "Rol Guardado Satisfactoriamente!"
                        );
                }
                break;
            case 'UPD':
                $result = Roles::update(
                    $this->viewData["rolescod"],
                    $this->viewData["rolesdsc"],
                    $this->viewData["rolesest"],
                );
                if ($result) {
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt_roles",
                        "Rol Actualizado Satisfactoriamente"
                    );
                }
                break;
            case 'DEL':
                $result = Roles::delete(
                    $this->viewData["rolescod"]
                );
                if ($result) {
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt_roles",
                        "Rol Eliminado Satisfactoriamente"
                    );
                }
                break;
            }
        }
    }

    private function processView()
    {
        if ($this->viewData["mode"] === "INS") {
            $this->viewData["mode_desc"]  = $this->arrModeDesc["INS"];
            $this->viewData["btnEnviarText"] = "Guardar Nuevo";
        } else {
            $this->viewData["mode_desc"]  = sprintf(
                $this->arrModeDesc[$this->viewData["mode"]],
                $this->viewData["rolescod"],
                $this->viewData["rolesdsc"]
            );
            $this->viewData["rolesestArr"]
                = \Utilities\ArrUtils::objectArrToOptionsArray(
                    $this->arrEstados,
                    'value',
                    'text',
                    'value',
                    $this->viewData["rolesest"]
                );

            if ($this->viewData["mode"] === "DSP") {
                $this->viewData["readonly"] = true;
                $this->viewData["showBtn"] = false;
            }
            if ($this->viewData["mode"] === "DEL") {
                $this->viewData["readonly"] = true;
                $this->viewData["btnEnviarText"] = "Eliminar";
            }
            if ($this->viewData["mode"] === "UPD") {
                $this->viewData["btnEnviarText"] = "Actualizar";
                $this->viewData["readonly"] = false;
            }
        }
        $this->viewData["crsf_token"] = md5(getdate()[0] . $this->name);
        $_SESSION[$this->name . "crsf_token"] = $this->viewData["crsf_token"];
    }






}

?>