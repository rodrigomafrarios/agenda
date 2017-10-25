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

class Contato extends Model
{

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

        $result = $sql->select("CALL sp_contatos_dados_save(:nomecontato,:codcontato,:emailpessoal,:emailtrabalho,:telefoneresidencial,:telefonetrabalho,:telefonecelular)",
            array(':nomecontato'         => $values["nome"],
                ':codcontato'          => isset($values["codContato"]) == true ? $values["codContato"] : 0,
                ':emailpessoal'        => isset($values["emailPessoal"]) == true ? $values["emailPessoal"] : 0,
                ':emailtrabalho'       => isset($values["emailTrabalho"]) == true ? $values["emailTrabalho"] : 0 ,
                ':telefoneresidencial' => isset($values["telefoneResidencial"]) == true ? $values["telefoneResidencial"] : 0,
                ':telefonetrabalho'    => isset($values["telefoneTrabalho"]) == true ? $values["telefoneTrabalho"] : 0,
                ':telefonecelular'     => isset($values["telefoneCelular"]) == true ? $values["telefoneCelular"] : 0
            ));

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
}