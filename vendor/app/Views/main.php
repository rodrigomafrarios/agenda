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
         <a href="#" class="btn btn-lg btn-primary" id="abrirModal" data-toggle="modal" data-target="#cadastro" role="button">Cadastrar contatos</a>
     </p>
</div>

<div id="contentResult"></div>

<div id="contentModal">
    <div class="modal fade" id="cadastro" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Cadastrar contato</h4>
                </div>
                <div class="modal-body" >
                    <div class="form-inline">
                        <div class="form-group has-feedback" id="containerName" >
                            <label class="control-label" for="nome">Nome</label><br/>
                            <input type="text" class="form-control inputModal" name="nome" placeholder="Nome" aria-describedby="sizing-addon2">
                        </div>
                        <br/><br/>
                        <div class="form-group has-feedback" id="containerTelefones" >
                            <label class="control-label">Telefones</label><br/>
                            <input type="text" class="form-control inputModal" id="telefoneResidencial" name="telefoneResidencial" placeholder="Telefone Residencial" aria-describedby="sizing-addon2">
                            <input type="text" class="form-control inputModal" id="telefoneComercial" name="telefoneComercial" placeholder="Telefone Comercial" aria-describedby="sizing-addon2">
                            <input type="text" class="form-control inputModal" id="telefoneCelular" name="telefoneCelular" placeholder="Telefone Celular" aria-describedby="sizing-addon2">
                        </div>
                        <br/><br/>
                        <div class="form-group has-feedback" id="containerEmails">
                            <label class="control-label">E-mails</label><br/>
                            <input type="text" class="form-control inputModal" id="emailPessoal" name="emailPessoal" placeholder="E-mail Pessoal" aria-describedby="sizing-addon2">
                            <input type="text" class="form-control inputModal" id="emailTrabalho" name="emailTrabalho" placeholder="E-mail Trabalho" aria-describedby="sizing-addon2">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <?php include_once ("error_box.php"); ?>
                    <br /><br /><br /><br />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="button" id="cadastrar" class="btn btn-success">Cadastrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once ("footer.php");
?>
