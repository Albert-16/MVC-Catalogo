<?php

namespace Controllers\Sec;

use Controllers\PublicController;

use Views\Renderer;

class Mail extends PublicController
{
    private $_viewData = array();
    private $generalError = "";
    public function run(): void
    {
        error_log(json_encode($this->_viewData));
        $this->SendMail();
        $this->_viewData = get_object_vars($this);
        Renderer::render("security/recoverPassword", $this->_viewData);
    }

    public function SendMail(){
        
    }
}