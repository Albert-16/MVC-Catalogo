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
use Dao\Mnt\Funciones as DaoFunciones;
use Views\Renderer;

/**
 * Funciones 
 *
 * @category Public
 * @package  Controllers\Mnt;
 * @author   Grupo #1
 * @license  MIT http://
 * @link     http://
 */
class Funciones extends PublicController 
{
    /**
     * Runs the controller
     *
     * @return void
     */
    public function run():void
    {
        // code
        
        $viewData = array();
        $viewData["Funciones"] = DaoFunciones::getAll();
        error_log(json_encode($viewData));
        
        Renderer::render('mnt/funciones', $viewData);
    }
}
?>
