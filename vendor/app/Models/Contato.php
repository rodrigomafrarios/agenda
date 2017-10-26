<?php
/**
 * Created by PhpStorm.
 * User: rodrigo.mafra
 * Date: 25/10/2017
 * Time: 16:12
 */

namespace app\Models;

use \app\DB\Sql;
use \app\Models\Model;
use \app\Models\PDOStatement;

class Contato extends Model
{
    private $emails    = array();
    private $telefones = array();

    /*
     *  nomecontato VARCHAR(100),
        codcontato INT,
        emailpessoal VARCHAR(45),
        emailtrabalho VARCHAR(45),
        telefoneresidencial VARCHAR(45),
        telefonetrabalho VARCHAR(45),
        telefonecelular VARCHAR(45)
     */
    public function save()
    {
        $values = $this->getValues();

        $sql = new Sql();


        if(isset($values["codContato"]) == true and empty($values["codContato"]) == true){
            $values["codContato"] = null;
        }
        if(isset($values["emailPessoal"]) == true and empty($values["emailPessoal"]) == true)
        {
            $values["emailPessoal"] = null;
        }
        if(isset($values["emailTrabalho"]) == true and empty($values["emailTrabalho"]) == true)
        {
            $values["emailTrabalho"] = null;
        }
        if(isset($values["telefoneResidencial"]) == true and empty($values["telefoneResidencial"]) == true)
        {
            $values["telefoneResidencial"] = null;
        }
        if(isset($values["telefoneComercial"]) == true and empty($values["telefoneComercial"]) == true)
        {
            $values["telefoneComercial"] = null;
        }
        if(isset($values["telefoneCelular"]) == true and empty($values["telefoneCelular"]) == true)
        {
            $values["telefoneCelular"] = null;
        }

        try{
            $result = $sql->select("CALL sp_contatos_dados_save(:nomecontato,:codcontato,:emailpessoal,:emailtrabalho,:telefoneresidencial,:telefonetrabalho,:telefonecelular)",
                array(':nomecontato'       => $values["nome"],
                    ':codcontato'          => $values["codContato"],
                    ':emailpessoal'        => $values["emailPessoal"],
                    ':emailtrabalho'       => $values["emailTrabalho"],
                    ':telefoneresidencial' => $values["telefoneResidencial"],
                    ':telefonetrabalho'    => $values["telefoneComercial"],
                    ':telefonecelular'     => $values["telefoneCelular"]
                ));
        }catch (\Exception $e){
            die($e);
        }


        $result = array_shift($result);
        $returnMessage = $result["returnMessage"];


        return $returnMessage;
    }

    public static function getAll()
    {
        $sql = new Sql();

        $result = $sql->select("SELECT cod,nome FROM contatos");

        return $result;
    }

    public static function getAllToReport()
    {
        $sql = new Sql();

        $result = $sql->select("SELECT c.cod,c.nome,ce.email,te.descricao as 'tipo_email',ct.telefone,tt.descricao as 'tipo_telefone'
                                         FROM contatos c
                                         LEFT JOIN contato_emails ce ON c.cod = ce.cod_contato
                                         LEFT JOIN tipos_emails te ON ce.cod_tipo_email = te.cod
                                         LEFT JOIN contato_telefones ct ON c.cod = ct.cod_contato
                                         LEFT JOIN tipos_telefones tt ON ct.cod_tipo_telefone = tt.cod;");

        return $result;
    }

    public function getByID($id)
    {
        $sql = new Sql();

        $result = $sql->select("SELECT c.cod,c.nome FROM contatos c WHERE c.cod = :codContato", array(":codContato" => $id));

        $this->setData(array_shift($result));

    }


    public function getTelefonesByID($id)
    {
        $sql = new Sql();

        $result[] = $sql->select("SELECT ct.telefone,ct.cod_tipo_telefone,tt.descricao
                                         FROM contatos c
                                         LEFT JOIN contato_telefones ct ON c.cod = ct.cod_contato
                                         INNER JOIN tipos_telefones tt ON ct.cod_tipo_telefone = tt.cod
                                         WHERE c.cod = :codContato", array(":codContato" => $id));

        $this->telefones = array_shift($result);

    }

    public function getEmailsByID($id)
    {
        $sql = new Sql();

        $result[] = $sql->select("SELECT ce.email,ce.cod_tipo_email,te.descricao
                                FROM contatos c
                                LEFT JOIN contato_emails ce ON c.cod = ce.cod_contato
                                INNER JOIN tipos_emails te ON ce.cod_tipo_email = te.cod
                                WHERE c.cod = :codContato", array(":codContato" => $id));

        $this->emails = array_shift($result);
    }

    public function getValuesByName($name)
    {
        $data = array();

        foreach ($this->{$name} as $key => $value)
        {
            $data[$key] = $value;
        }

        return $data;
    }

    public function deleteContact($id)
    {
        $sql = new Sql();
        $sql->query("DELETE FROM contatos WHERE cod = :codContato",array(":codContato" => $id));
    }
    public function deleteEmailsContact($id)
    {
        $sql = new Sql();
        $sql->query("DELETE FROM contato_emails WHERE cod_contato = :codContato",array(":codContato" => $id));
    }
    public function deleteTelefonesContact($id)
    {
        $sql = new Sql();
        $sql->query("DELETE FROM contato_telefones WHERE cod_contato = :codContato",array(":codContato" => $id));
    }
}