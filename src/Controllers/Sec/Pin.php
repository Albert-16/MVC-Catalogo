<?php

namespace Controllers\Sec;

use Controllers\PublicController;

use Views\Renderer;

class Pin extends PublicController
{
    private $_viewData = array();
    public function run(): void
    {
        error_log(json_encode($this->_viewData));
        $this->_viewData = get_object_vars($this);
        Renderer::render("security/pin", $this->_viewData);
    }

}