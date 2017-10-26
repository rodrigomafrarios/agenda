<?php
/**
 * Created by PhpStorm.
 * User: rodrigo.mafra
 * Date: 24/10/2017
 * Time: 13:27
 */

namespace app\Controllers;

use \app\Models\Contato;

class RelatoriosController
{
    public function getDataToReport()
    {
        try{
            $data = Contato::getAllToReport();
        }catch (\Exception $e){
            $data = array();
        }

        echo json_encode($data);
        exit;

    }

    public function tableReport()
    {
       require_once(getcwd().AppController::PATH_VIEW."tableReport.php");
    }
}