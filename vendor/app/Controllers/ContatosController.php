<?php
/**
 * Created by PhpStorm.
 * User: rodrigo.mafra
 * Date: 24/10/2017
 * Time: 13:26
 */

namespace app\Controllers;


use app\Models\Contato;

class ContatosController
{
    public function add()
    {
        require_once(getcwd().AppController::PATH_VIEW."adicionarContato.php");
    }

    public function doAdd()
    {

        //checa se o nome foi preenchido
        if(isset($_POST["nome"]) == false and empty($_POST["nome"]) == true)
        {
            json_encode(array("msg" => utf8_encode("nome não preenchido"), "success" => false));
        }

        $contato = new Contato();
        $contato->setData($_POST);

        $result = $contato->save();

        echo json_encode(array("msg" => $result,"success" => true));
        exit;
    }

    public function manage()
    {
        require_once(getcwd().AppController::PATH_VIEW."editarContato.php");
    }

    public function getDataToManagement()
    {
        try{
            $contatos = Contato::getAll();
        }catch (\Exception $e){
            $contatos = array();
        }

        echo json_encode($contatos);
    }

}