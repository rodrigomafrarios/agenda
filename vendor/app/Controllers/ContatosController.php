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

        $contact = new Contato();
        $contact->setData($_POST);

        $result = $contact->save();

        echo json_encode(array("msg" => $result,"success" => true));
        exit;
    }

    public function manage()
    {
        require_once(getcwd().AppController::PATH_VIEW."manageContato.php");
    }

    public function getDataToManagement()
    {
        try{
            $contacts = Contato::getAll();
        }catch (\Exception $e){
            $contacts = array();
        }

        echo json_encode($contacts);
    }

    public function getDataToEdit()
    {
        $getVars = array();

        parse_str($_SERVER["REQUEST_URI"],$getVars);
        $contact = new Contato();


        $contact->getByID($getVars["codContato"]);
        $contact->getTelefonesByID($getVars["codContato"]);
        $contact->getEmailsByID($getVars["codContato"]);

        $resp = array();

        $resp["data"] = $contact->getValues();
        $resp["emails"] = $contact->getValuesByName('emails');
        $resp["telefones"] = $contact->getValuesByName('telefones');

        echo json_encode($resp);
    }

    public function edit()
    {
        require_once(getcwd().AppController::PATH_VIEW."editarContato.php");
    }

    public function doEdit()
    {
        //checa se o nome foi preenchido
        if(isset($_POST["nome"]) == false and empty($_POST["nome"]) == true)
        {
            json_encode(array("msg" => utf8_encode("nome não preenchido"), "success" => false));
        }

        $contact = new Contato();
        $contact->setData($_POST);

        $result = $contact->save();

        echo json_encode(array("msg" => $result,"success" => true));
        exit;
    }

    public function delete()
    {
        $getVars = array();

        parse_str($_SERVER["REQUEST_URI"],$getVars);

        $contact = new Contato();
        $contact->deleteContact($getVars["codContato"]);
        $contact->deleteEmailsContact($getVars["codContato"]);
        $contact->deleteTelefonesContact($getVars["codContato"]);

    }

}