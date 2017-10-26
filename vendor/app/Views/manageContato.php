<?php
/**
 * Created by PhpStorm.
 * User: rodrigo.mafra
 * Date: 25/10/2017
 * Time: 18:32
 */

require_once("header.php");?>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">

                <div class="box-body no-padding">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Nome do contato</th>
                            <th style="width: 240px">A&ccedil;&otilde;es</th>
                        </tr>
                        </thead>
                        <tbody id="tBodyMgr">

                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

</section>


<?php require_once("footer.php");?>

<script>
   $(document).ready(function () {

       var url          = window.location.href;

       var hashes       = url.split("?")[1];
       var decodedJson  = decodeURIComponent(hashes);
       var aux          = decodedJson.substring(decodedJson.indexOf("=")+1,decodedJson.length);
       var contatos     = $.parseJSON(aux);
       var montaBody    = "";

       for(var i = 0; i < contatos.length; i++)
       {
           montaBody += '<tr>';
           montaBody += '   <td>' + contatos[i].cod +'</td>';
           montaBody += '   <td>' + contatos[i].nome +'</td>';
           montaBody += '   <td>';
           montaBody += '       <button onclick="Agenda.editar('+contatos[i].cod+');" id="editar-' + contatos[i].cod + '" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</button>';
           montaBody += '       <button onclick="Agenda.excluir('+contatos[i].cod+');" id="deletar-' + contatos[i].cod + '" onclick="return confirm("Deseja realmente excluir este registro?")" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Excluir</button>';
           montaBody += '   </td>';
           montaBody += '</tr>';
       }

       $('#tBodyMgr').append(montaBody);

   });

</script>
