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

    toPopulateHTML : function ($controller,$method,$callback) {

        $.ajax({
            url : '/'+$controller+'/'+$method,
            type: 'GET',
            success : function (data) {

                window.location.href = '/'+$controller+'/'+$callback+'?data='+data;
            }
        });
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
            Agenda.toPopulateHTML('contatos','getDataToManagement','manage');
        });

        $('#reports').click(function () {
            console.log("clicou em reports");
            Agenda.toPopulateHTML('relatorios','getDataToReport','tableReport');
        });

    }
}