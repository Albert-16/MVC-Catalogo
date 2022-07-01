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
use Dao\Mnt\Scores as DaoScores;
use Views\Renderer;

/**
 * Scores
 *
 * @category Public
 * @package  Controllers\Mnt;
 * @author   Grupo #1
 * @license  MIT http://
 * @link     http://
 */
class Scores extends PublicController //Nos permite tener los controladores adecuados
//Recordemos que el PublicController nos obliga a usar el metodo run para devolver algun tipo de vista
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
        $viewData["Scores"] = DaoScores::getAll();
        error_log(json_encode($viewData));
        
        Renderer::render('mnt/scores', $viewData);
    }
}
?>