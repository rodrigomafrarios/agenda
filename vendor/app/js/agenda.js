/**
 * Created by rodrigo.mafra on 24/10/2017.
 */

var Agenda = {

    events : function() {

        $('#openModalAdd').click(function(){

            $('#modalAdd').dialog({
                buttons:[
                    {
                        text:"OK",
                        click: function()
                        {
                            $( this ).dialog( "close" );
                        }
                    }
                ]

            });

        });

        $("#cadastro").on("hidden.bs.modal", function(){
            $("#cadastro").html("");

            var $modal = '';
            $modal += '<div class="modal fade" id="cadastro" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">';
            $modal += '<div class="modal-dialog modal-lg">';
            $modal += '<div class="modal-content">';
            $modal += '<div class="modal-header">';
            $modal += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            $modal += '<h4 class="modal-title">Cadastrar contato</h4>';
            $modal += '</div>';
            $modal += '<div class="modal-body" >';
            $modal += '<div class="input-group">';
            $modal += '<div>';
            $modal += '<label for="nome">Nome</label><br/>';
            $modal += '<input type="text" class="form-control inputModal" name="nome" placeholder="Nome" aria-describedby="sizing-addon2">';
            $modal += '</div>';
            $modal += '<br/><br/>';
            $modal += '<div id="containerTelefones">';
            $modal += '<label for="nome">Telefones</label><br/>';
            $modal += '<input type="text" class="form-control inputModal" id="telefone1" name="telefones[]" placeholder="Telefone" aria-describedby="sizing-addon2">';
            $modal += '<span id="adicionarTelefones1" class="glyphicon glyphicon-plus " onclick="Agenda.functions.adicionaInputs(this)" cursor: pointer;"></span>';
            $modal += '<span id="removerTelefones1" class="glyphicon glyphicon-remove " onclick="Agenda.functions.removeInputs(this)"   cursor: pointer;"></span>';
            $modal += '</div>';
            $modal += '<br/><br/>';
            $modal += '<div id="containerEmails">';
            $modal += '<label for="email">E-mails</label><br/>';
            $modal += '<input type="text" class="form-control inputModal" id="email1" name="emails[]" placeholder="E-mail" aria-describedby="sizing-addon2">';
            $modal += '<span id="adicionarEmails1" class="glyphicon glyphicon-plus " onclick="Agenda.functions.adicionaInputs(this)" style="cursor: pointer;"></span>';
            $modal += '<span id="removerEmails1" class="glyphicon glyphicon-remove " onclick="Agenda.functions.removeInputs(this)"   style="cursor: pointer;"></span>';
            $modal += '</div>';
            $modal += '</div>';
            $modal += '</div>';
            $modal += '<div class="modal-footer">';
            $modal += '<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>';
            $modal += '<button type="button" class="btn btn-success">Cadastrar</button>';
            $modal += '</div>';
            $modal += '</div>';
            $modal += '</div>';
            $modal += '</div>';

            $("#cadastro").html($modal);
        });

    },

    functions : {

        adicionaInputs :function (input)
        {

            var $container = $(input).parent().attr('id');
            var qtdInputs = $('#'+$container).find('input').length + 1;

            console.log("quantidade de inputs");
            console.log(qtdInputs);

            var appendInput = "";

            var name     = "";
            var inputID  = "";
            var addID    = "";
            var removeID = "";

            if($container === 'containerTelefones')
            {
                name     = "telefones[]";
                inputID  = "telefone";
                addID    = "adicionarTelefones";
                removeID = "removerTelefones";
            }
            if($container === 'containerEmails')
            {
                name     = "emails[]";
                inputID  = "email";
                addID    = "adicionarEmails";
                removeID = "removerEmails";
            }

            appendInput += "<input type='text' name='"+name+"' class='form-control' id='" + inputID + qtdInputs + "' style='width: 75%;margin-bottom: 3%;'>";
            appendInput += "<span id='" + addID + qtdInputs + "'    onclick='Agenda.functions.adicionaInputs(this)' class='glyphicon glyphicon-plus' style='cursor:pointer;'></span>";
            appendInput += "<span id='" + removeID + qtdInputs + "' onclick='Agenda.functions.removeInputs(this)' class='glyphicon glyphicon-remove' style='cursor:pointer;'></span>";


            $('#'+$container).append(appendInput);
        },

        removeInputs: function (input)
        {
            console.log("removeInputs");

            var id = $(input).attr('id');
            id = id.substring(id.length,id.length-1);

            console.log("id" + id);

            var number = id.substring(id.length-1,id.length);

            console.log("numero" + number);


            $target = id + number;


            $('#' + $target).remove();
            $('#removerEmails' + number).remove();
            $('#adicionarEmails' + number).remove();
        }

    },

    init : function () {


        Agenda.events();


    }



}