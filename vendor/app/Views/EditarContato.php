<?php
/**
 * Created by PhpStorm.
 * User: rodrigo.mafra
 * Date: 26/10/2017
 * Time: 15:01
 */

require_once("header.php");

?>

<h3>Editar contato</h3><br/><br/>
<div class="form-inline">
    <div class="form-group has-feedback" id="containerName" >
        <label class="control-label" for="nome">Nome</label><br/>
        <input type="text" class="form-control inputModal" name="nome" placeholder="Nome" aria-describedby="sizing-addon2">
        <input type="hidden" name="codContato" />
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
    <br /><br /><br /><br />
    <div align="center">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        <button type="button" id="editar" class="btn btn-success">Editar</button>
    </div>
    <?php include_once ("error_box.php"); ?>
</div>
<?php require_once("footer.php"); ?>

<script>

    $(document).ready(function () {

        var url          = window.location.href;

        var hashes       = url.split("?")[1];
        var decodedJson  = decodeURIComponent(hashes);
        var aux          = decodedJson.substring(decodedJson.indexOf("=")+1,decodedJson.length);
        var contato      = $.parseJSON(aux);
        var emails       = contato.emails;
        var telefones    = contato.telefones;

        $('input[name="nome"]').val(contato.data.nome);
        $('input[name="codContato"]').val(contato.data.cod);

        for(var i = 0; i < emails.length; i++)
        {
            if(emails[i].descricao === 'PESSOAL')
            {
                $('#emailPessoal').val(emails[i].email);
            }
            if(emails[i].descricao === 'TRABALHO')
            {
                $('#emailTrabalho').val(emails[i].email);
            }
        }

        for(var i = 0; i < telefones.length; i++)
        {

            if(telefones[i].descricao === 'CELULAR')
            {
                $('#telefoneCelular').val(telefones[i].telefone);
            }
            if(telefones[i].descricao === 'RESIDENCIAL')
            {
                $('#telefoneComercial').val(telefones[i].telefone);
            }
            if(telefones[i].descricao === 'TRABALHO')
            {
                $('#telefoneResidencial').val(telefones[i].telefone);
            }
        }

    });


</script>


