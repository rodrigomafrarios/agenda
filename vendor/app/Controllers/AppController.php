<?php

/**
 * Created by PhpStorm.
 * User: rodrigo.mafra
 * Date: 24/10/2017
 * Time: 12:56
 */

namespace app\Controllers;

use \app\Controllers\ContatosController;
use \app\Controllers\RelatoriosController;
use \app\Controllers\MainController;

class AppController
{
    const PATH_VIEW = "/vendor/app/Views/";

    public function __construct()
    {
        $route = array_keys($_REQUEST);

        if(empty($route) == true)
        {
            $app = new MainController();
            $app->Main();
        }
        else
        {
            $controller = substr($route[0],1,strlen($route[0]));
            $method     = substr($controller,strpos($controller,"/")+1,strlen($controller)-1);
            $controller = substr($controller,0,strpos($controller,"/"));


            if($controller == 'contatos')
            {
                $app = new ContatosController();
                $app->{$method}();

            }

            if($controller == 'relatorios')
            {
                $app = new RelatoriosController();
                $app->{$method}();

            }

        }



    }
}