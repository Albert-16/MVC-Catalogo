<?php

namespace Controllers\Mnt;

use Controllers\PublicController;
use Views\Renderer;
use Utilities\Validators;
use Dao\Mnt\usuarios;

class usuarioMnt extends PublicController
{
    private $viewData = array();
    private $arrModeDesc = array();
    private $arrEstados = array();
    private $arrEstadosPassword = array();

    public function run():void
    {
        $this->init();
        if (!$this->isPostBack()) {
            $this->procesarGet();
        }

        if ($this->isPostBack()) {
            $this->procesarPost();
        }

        $this->processView();
        Renderer::render('mnt/usuarioMnt', $this->viewData);
    }

    private function init()
    {
        $this->viewData = array();
        $this->viewData["mode"] = "";
        $this->viewData["mode_desc"] = "";
        $this->viewData["crsf_token"] = "";

        $this->viewData["usercod"] = "";
        $this->viewData["useremail"] = "";
        $this->viewData["error_useremail"] = array();

        $this->viewData["username"] = "";
        $this->viewData["error_username"] = array();

        $this->viewData["userpswd"] = "";
        $this->viewData["error_userpswd"] = array();

        $this->viewData["userfching"] = "";
        $this->viewData["error_userfching"] = array();

        $this->viewData["userpswdest"] = "";
        $this->viewData["userpswdestArr"] = array();

        $this->viewData["userpswdexp"] = "";
        $this->viewData["error_userpswdexp"] = array();

        $this->viewData["userest"] = "";
        $this->viewData["userestArr"] = array();

        $this->viewData["useractcod"] = "";
        $this->viewData["error_useractcod"] = array();

        $this->viewData["userpswdchg"] = "";
        $this->viewData["error_userpswdchg"] = array();

        $this->viewData["usertipo"] = "";
        $this->viewData["error_usertipo"] = array();

        $this->viewData["btnEnviarText"] = "Guardar";
        $this->viewData["readonly"] = false;
        $this->viewData["showBtn"] = true;
    
        $this->arrModeDesc = array(
            "INS"=>"Registrar usuario",
            "UPD"=>"Editar usuario: %s %s",
            "DSP"=>"Detalle de usuario: %s %s",
            "DEL"=>"Eliminando usuario: %s %s"
        );

        $this->arrEstados = array(
            array("value" => "ACT", "text" => "Activo"),
            array("value" => "INA", "text" => "Inactivo"),
        );
        $this->arrEstadosPassword = array(
            array("value" => "ACT", "text" => "Activo"),
            array("value" => "INA", "text" => "Inactivo"),
        );

        $this->viewData["userestArr"] = $this->arrEstados;
        $this->viewData["userpswdestArr"] = $this->arrEstadosPassword;

    }

    private function procesarGet()
    {
        if (isset($_GET["mode"])) {
            $this->viewData["mode"] = $_GET["mode"];
            if (!isset($this->arrModeDesc[$this->viewData["mode"]])) {
                error_log('Modo de operación desconocido.');
                \Utilities\Site::redirectToWithMsg(
                    "index.php?page=mnt_usuariosMnt",
                    "No se puede procesar la solicitud."
                );
            }
        }

        if ($this->viewData["mode"] !== "INS" && isset($_GET["id"])) {
            $this->viewData["usercod"] = intval($_GET["id"]);
            $tmpusuario = usuarios::getById($this->viewData["usercod"]);
            error_log(json_encode($tmpusuario));
            \Utilities\ArrUtils::mergeFullArrayTo($tmpusuario, $this->viewData);
        }
    }

    private function procesarPost()
    {
        $hasErrors = false;
        
        \Utilities\ArrUtils::mergeArrayTo($_POST, $this->viewData);
        if (isset($_SESSION[$this->name . "crsf_token"])
            && $_SESSION[$this->name . "crsf_token"] !== $this->viewData["crsf_token"]
        ) {
            \Utilities\Site::redirectToWithMsg(
                "index.php?page=mnt_usuariosMnt",
                "Error al realizar la solicitud, intente de nuevo."
            );
        }
        
        if (Validators::IsEmpty($this->viewData["useremail"])) {
            $this->viewData["error_useremail"][]
                = "Campo obligatorio.";
            $hasErrors = true;
        }

        if (Validators::IsEmpty($this->viewData["username"])) {
            $this->viewData["error_username"][]
                = "Campo obligatorio.";
            $hasErrors = true;
        }
        if (Validators::IsEmpty($this->viewData["userpswd"])) {
            $this->viewData["error_userpswd"][]
                = "Campo obligatorio.";
            $hasErrors = true;
        }       
        if (Validators::IsEmpty($this->viewData["userfching"])) {
            $this->viewData["error_userfching"][]
                = "Campo obligatorio.";
            $hasErrors = true;
        }
        if (Validators::IsEmpty($this->viewData["userpswdexp"])) {
            $this->viewData["error_userpswdexp"][]
                = "Campo obligatorio.";
            $hasErrors = true;
        }
        if (Validators::IsEmpty($this->viewData["useractcod"])) {
            $this->viewData["error_useractcod"][]
                = "Campo obligatorio.";
            $hasErrors = true;
        }
        if (Validators::IsEmpty($this->viewData["userpswdchg"])) {
            $this->viewData["error_userpswdchg"][]
                = "Campo obligatorio.";
            $hasErrors = true;
        }
        if (Validators::IsEmpty($this->viewData["usertipo"])) {
            $this->viewData["error_usertipo"][]
                = "Campo obligatorio.";
            $hasErrors = true;
        }
 

        error_log(json_encode($this->viewData));

        if (!$hasErrors) {
            $result = null;

            switch($this->viewData["mode"]) {
                case 'INS':
                    $result = usuarios::insert(
                        $this->viewData["useremail"],
                        $this->viewData["username"],
                        $this->viewData["userpswd"],
                        $this->viewData["userfching"],
                        $this->viewData["userpswdest"],
                        $this->viewData["userpswdexp"],
                        $this->viewData["userest"],
                        $this->viewData["useractcod"],
                        $this->viewData["userpswdchg"] ,
                        $this->viewData["usertipo"]
                    );

                    if ($result) {
                        \Utilities\Site::redirectToWithMsg("index.php?page=mnt_usuariosMnt","usuario Registrado.");
                    }
                break;

                case 'UPD':
                    $result = usuarios::update(
                        $this->viewData["useremail"],
                        $this->viewData["username"],
                        $this->viewData["userpswd"],
                        $this->viewData["userfching"],
                        $this->viewData["userpswdest"],
                        $this->viewData["userpswdexp"],
                        $this->viewData["userest"],
                        $this->viewData["useractcod"],
                        $this->viewData["userpswdchg"],
                        $this->viewData["usertipo"],
                        $this->viewData["usercod"]               
                    );

                    if ($result) {
                        \Utilities\Site::redirectToWithMsg("index.php?page=mnt_usuariosMnt","usuario Actualizado.");
                    }
                break;

                case 'DEL':
                    $result = usuarios::delete(
                        intval($this->viewData["usercod"])
                    );
                    if ($result) {
                        \Utilities\Site::redirectToWithMsg("index.php?page=mnt_usuariosMnt","usuario Eliminado.");
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
                $this->viewData["usercod"],
                $this->viewData["username"]
            );

            $this->viewData["userestArr"] =
                \Utilities\ArrUtils::objectArrToOptionsArray(
                    $this->arrEstados,
                    'value',
                    'text',
                    'value',
                    $this->viewData["userest"]
            );
            $this->viewData["userpswdestArr"] =
                \Utilities\ArrUtils::objectArrToOptionsArray(
                    $this->arrEstados,
                    'value',
                    'text',
                    'value',
                    $this->viewData["userpswdest"]
            );

            if ($this->viewData["mode"] === "DSP") {
                $this->viewData["readonly"] = true;
                $this->viewData["showBtn"] = false;
            }

            if ($this->viewData["mode"] === "DEL") {
                $this->viewData["readonly"] = true;
                $this->viewData["btnEnviarText"] = "Eliminar usuario";
            }

            if ($this->viewData["mode"] === "UPD") {$this->viewData["btnEnviarText"] = "Actualizar usuario";
                $this->viewData["readonly"] = false;
            }
        }

        //Token CRSF
        $this->viewData["crsf_token"] = md5(getdate()[0] . $this->name);
        $_SESSION[$this->name . "crsf_token"] = $this->viewData["crsf_token"];
    }
}
?>