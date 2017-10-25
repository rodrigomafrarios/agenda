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

                <div class="box-header">
                    <a href="/contatos/add" class="btn btn-success">Cadastrar contato</a>
                </div>

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

                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <a href="contatos/edit" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a>
                                <a href="contatos/delete" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Excluir</a>
                            </td>
                        </tr>

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
   $(document).

</script>
