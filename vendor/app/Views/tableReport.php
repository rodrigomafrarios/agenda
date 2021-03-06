<?php
/**
 * Created by PhpStorm.
 * User: rodrigo.mafra
 * Date: 26/10/2017
 * Time: 19:57
 */

require_once("header.php");

?>

<section class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body no-padding">
                    <div align="right">
                        <label for="buscaTable">Busca: </label>
                        <input  id="buscaTable" />
                    </div>
                    <br />
                    <table class="table table-striped" id="tableReport">
                        <thead>
                        <tr>
                            <th style="width: 10px">id</th>
                            <th>Nome do contato</th>
                            <th>E-mail</th>
                            <th>Tipo e-mail</th>
                            <th>Telefone</th>
                            <th>Tipo telefone</th>
                        </tr>
                        </thead>
                        <tbody id="tBodyReport">
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="contact-pagination text-center">
                <nav>
                    <ul class="pagination">

                    </ul>
                </nav>
            </div>
        </div>
    </div>

</section>

<?php require_once("footer.php"); ?>

<script>

    $(document).ready(function () {

        var url          = window.location.href;

        var hashes       = url.split("?")[1];
        var decodedJson  = decodeURIComponent(hashes);
        var aux          = decodedJson.substring(decodedJson.indexOf("=")+1,decodedJson.length);
        var report       = $.parseJSON(aux);
        var total        = report.total;
        var pagination   = report.pages;
        report           = report.data;
        var montaBody    = "";


        for(var i = 0; i < report.length; i++)
        {
            montaBody += '<tr class="dadosContato">';
            montaBody += '   <td class="busca">' + report[i].cod +'</td>';
            montaBody += '   <td class="busca">' + report[i].nome +'</td>';

            if(report[i].email === null || report[i].email === undefined)
            {
                montaBody += '   <td class="busca">-</td>';
            }
            else
            {
                montaBody += '   <td class="busca">' + report[i].email +'</td>';
            }

            if(report[i].tipo_email === null || report[i].tipo_email === undefined)
            {
                montaBody += '   <td class="busca">-</td>';
            }
            else
            {
                montaBody += '   <td class="busca">' + report[i].tipo_email +'</td>';
            }

            if(report[i].telefone === null || report[i].telefone === undefined)
            {
                montaBody += '   <td class="busca">-</td>';
            }
            else
            {
                montaBody += '   <td class="busca">' + report[i].telefone +'</td>';
            }
            if(report[i].tipo_telefone === null || report[i].tipo_telefone === undefined)
            {
                montaBody += '   <td class="busca">-</td>';
            }
            else
            {
                montaBody += '   <td class="busca">' + report[i].tipo_telefone +'</td>';
            }

            montaBody += '</tr>';
        }

        $('#tBodyReport').append(montaBody);

        for(var i = 1; i < pagination; i++)
        {
            $('.pagination').append('<li><a onclick="Agenda.pagination('+i+')" href="#">'+i+'</a></li>');
        }

    });

</script>
