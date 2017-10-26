/**
 * Created by rodrigo.mafra on 24/10/2017.
 */

// constantes
var $body = $('body');
var TEMPO_ERRO_NA_TELA_MS = 10000;

var Agenda =
{
    init : function () {
        Agenda.events();

        $('#contentResult').hide();

        $('#telefoneCelular').mask(
            '(99) 99999-9999'
        );
        $('#telefoneResidencial').mask(
            '(99) 9999-9999'
        );
        $('#telefoneComercial').mask(
            '(99) 9999-9999'
        );

        $('#emailPessoal,#emailTrabalho').mask("A", {
            translation: {
                "A": { pattern: /[\w@\-.+]/, recursive: true }
            }
        });
    },

    showError : function(message, title)
    {
        var container = '';
        var resposta  = '';

        if(title === undefined || title === '' || title === null || title == 'Erro')
        {
            title = 'Erro';
            container = '.alert-container';
            resposta = 'erro';
        }

        if(title === 'Sucesso')
        {
            container = '.success-container';
            resposta  = 'sucesso';
        }

        // obtem o alert
        var $alert = $body.find(container);

        $alert.find('.titulo-'+resposta).text(title + '!');
        $alert.find('.mensagem-'+resposta).text(message);



        // mostra na tela
        $body.find(container)
            .removeClass('hidden')
            .hide()
            .fadeIn(400, function()
            {
                // depois de X segundos tira da tela
                setTimeout(
                    function()
                    {
                        $body.find(container).fadeOut();

                    }, TEMPO_ERRO_NA_TELA_MS
                );

                if(title === 'Sucesso')
                {
                    location.reload();
                }

                return false;


            });
    },

    formValidation: function ($class,$action)
    {
        var $inputs                  = $('.' + $class).find('input');
        var msg                      = $('#msgError').val();
        var formData                 = new FormData();


        //percorre os inputs
        for(var i = 0; i < $inputs.length;i++)
        {
            //checa se o input está vazio
            if($($inputs[i]).val().length === 0 && $($inputs[i]).attr('name') === 'nome')
            {
                var msg = $('#msgErrorNome').val();
                Agenda.showError(msg,'Erro');
                return false;
            }
            else
            {
                formData.append($($inputs[i])[0].name,$($inputs[i]).val());
            }
        }

        //abre requisição AJAX
        var req = new XMLHttpRequest();
        req.open("POST","/contatos/"+$action,true);

        req.onreadystatechange = function () {

            if(this.readyState === 4 && this.status === 200)
            {
                var response = this.response;
                response = $.parseJSON(response);

                if($action === 'doEdit')
                {
                    $.ajax({
                        url : '/contatos/getDataToManagement',
                        type: 'GET',
                        success : function (data) {
                            window.location.href = '/contatos/manage?data='+data;
                        }
                    });
                }

                Agenda.showError(response.msg,'Sucesso');
            }
        };
        req.send(formData);
    },

    toPopulateHTML : function ($controller,$method,$callback,$pagination) {
        var url = '/'+$controller+'/'+$method;

        if($pagination !== null)
        {
            url = url + '&pagination=' + $pagination;
        }

        $.ajax({
            url : url,
            type: 'GET',
            success : function (data) {

                window.location.href = '/'+$controller+'/'+$callback+'?data='+data;
            }
        });
    },

    pagination : function ($pagination) {
        Agenda.toPopulateHTML('relatorios','getDataToReport','tableReport',$pagination);
    },

    editar : function (id) {

        $.ajax({
            url : '/contatos/getDataToEdit&codContato='+id,
            type: 'GET',

            success : function (data) {
                window.location.href = '/contatos/edit?data='+data;
            }
        });

    },

    excluir : function (id) {

        $.ajax({
            url : '/contatos/delete&codContato='+id,
            type: 'GET',

            success : function ()
            {
                $.ajax({
                    url : '/contatos/getDataToManagement',
                    type: 'GET',
                    success : function (data) {

                        window.location.href = '/contatos/manage?data='+data;
                    }
                });
            }
        });
    },

    events : function() {

        $('#cadastrar').click(function () {
            Agenda.formValidation('modal-body','doAdd')
        });
        $('#editar').click(function () {
            Agenda.formValidation('form-inline','doEdit')
        });

        $('#gerenciar').click(function () {
            Agenda.toPopulateHTML('contatos','getDataToManagement','manage',null);
        });

        $('#reports').click(function () {
            Agenda.toPopulateHTML('relatorios','getDataToReport','tableReport',1);
        });

        var idTimeout = 0;

        $("#buscaTable").keyup(function(){

            // checa se ja existe um evento em andamento
            if(idTimeout != 0)
            {
                clearTimeout(idTimeout);
            }

            idTimeout = setTimeout(function(){

                // zera o timeout
                idTimeout = 0;

                // faz a busca
                var texto = $("#buscaTable").val();

                // remove  a tbody da tela para trata-la
                var $tbody = $('#tBodyReport').detach();

                $tbody.find(".dadosContato").each(function(){

                    // concatena todas as tds em uma unica string para fazer a busca
                    var strTodasColunas = '';

                    $(this).find('td.busca').each(function(){

                        strTodasColunas += $.trim($(this).text());
                    });

                    if(texto !== undefined)
                    {
                        var resultado = strTodasColunas.toUpperCase().indexOf(texto.toUpperCase());

                        if(resultado < 0) {
                            $(this).hide();
                        }else {
                            $(this).show();
                        }
                    }
                });

                // terminada a busca volta o tbody pra tela
                $("#tableReport").append($tbody);

            }, 400);

        });

    }
}