<?php
/**
 * Created by PhpStorm.
 * User: rodrigo.mafra
 * Date: 25/10/2017
 * Time: 13:02
 */

?>

<div class="form-group form-box checkbox-map alert-container hidden">
    <div class="col-sm-12 padding-0">
        <div align="center" class="alert alert-danger alert-dismissible" role="warning">
            <strong class="titulo-erro"></strong> <span class="mensagem-erro"></span>
        </div>
    </div>
</div>

<div class="form-group form-box checkbox-map success-container hidden">
    <div class="col-sm-12 padding-0">
        <div align="center" class="alert alert-success alert-dismissible" role="success">
            <strong class="titulo-sucesso"></strong> <span class="mensagem-sucesso"></span>
        </div>
    </div>
</div>

<input type="hidden" id="msgError" value="Alguns campos n&atilde;o foram preenchidos">
<input type="hidden" id="msgErrorNome" value="O nome n&atilde;o foi preenchido">
<input type="hidden" id="msgErrorEmail" value="Preencha pelo menos um e-mail">
<input type="hidden" id="msgErrorTelefone" value="Preencha pelo menos um telefone">
