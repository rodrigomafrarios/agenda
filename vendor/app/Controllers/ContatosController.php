<?php
/**
 * Created by PhpStorm.
 * User: rodrigo.mafra
 * Date: 24/10/2017
 * Time: 13:26
 */

namespace app\Controllers;


class ContatosController
{
    public function add()
    {
        require_once(getcwd().AppController::PATH_VIEW."adicionarContato.php");
    }
}