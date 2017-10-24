<?php
/**
 * Created by PhpStorm.
 * User: rodrigo.mafra
 * Date: 24/10/2017
 * Time: 13:26
 */

include_once ("header.php");

?>
<div class="jumbotron">
    <h1>Agenda de desenvolvedores</h1>
    <p>Seja bem-vindo &agrave; agenda de desenvolvedores!</p>
     <p>
         <a href="#" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#cadastro" role="button">Cadastrar contatos</a>
     </p>
</div>

<div class="modal fade" id="cadastro" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Cadastrar contato</h4>
            </div>
            <div class="modal-body" >
                <div class="input-group">
                    <div>
                        <label for="nome">Nome</label><br/>
                        <input type="text" class="form-control inputModal" name="nome" placeholder="Nome" aria-describedby="sizing-addon2">
                    </div>
                    <br/><br/>
                    <div id="containerTelefones">
                        <label for="nome">Telefones</label><br/>
                        <input type="text" class="form-control inputModal" id="telefone1" name="telefones[]" placeholder="Telefone" aria-describedby="sizing-addon2">
                        <span id="adicionarTelefones1" class="glyphicon glyphicon-plus " onclick="Agenda.functions.adicionaInputs(this)" style="font-size: 153%; left: -11%; padding: 2%; color: #0d4f87; cursor: pointer; margin-bottom: 9%;"></span>
                        <span id="removerTelefones1" class="glyphicon glyphicon-remove " onclick="Agenda.functions.removeInputs(this)"   style="font-size: 145%; left: -6%; color: #0d4f87; cursor: pointer; margin-bottom: 9%;"></span>
                    </div>
                    <br/><br/>
                    <div id="containerEmails">
                        <label for="email">E-mails</label><br/>
                        <input type="text" class="form-control inputModal" id="email1" name="emails[]" placeholder="E-mail" aria-describedby="sizing-addon2">
                        <span id="adicionarEmails1" class="glyphicon glyphicon-plus " onclick="Agenda.functions.adicionaInputs(this)" style="font-size: 153%; left: -11%; padding: 2%; color: #0d4f87; cursor: pointer; margin-bottom: 9%;"></span>
                        <span id="removerEmails1" class="glyphicon glyphicon-remove " onclick="Agenda.functions.removeInputs(this)"   style="font-size: 145%; left: -6%; color: #0d4f87; cursor: pointer; margin-bottom: 9%;"></span>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-success">Cadastrar</button>
            </div>
        </div>
    </div>
</div>
<?php

include_once ("footer.php");

?>
