<?php
/**
 * Created by PhpStorm.
 * User: rodrigo.mafra
 * Date: 24/10/2017
 * Time: 13:23
 */

namespace app\Controllers;

class MainController
{
    public function Main()
    {
        require_once(getcwd().AppController::PATH_VIEW."main.php");
    }


}