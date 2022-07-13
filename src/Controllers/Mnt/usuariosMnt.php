<?php
namespace Controllers\Mnt;

use Controllers\PublicController;
use Dao\Mnt\usuarios as Daousuarios;
use Views\Renderer;

class usuariosMnt extends PublicController
{
    public function run():void
    {
        $viewData = array();
        $viewData["usuarios"] = Daousuarios::getAll();
    
        Renderer::render('mnt/usuariosMnt', $viewData);
    }
}
?>