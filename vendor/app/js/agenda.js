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

        console.log("container: " + container);

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

    formValidation: function ($class)
    {
        var $inputs                  = $('.' + $class).find('input');
        var msg                      = $('#msgError').val();
        var formData                 = new FormData();


        //percorre os inputs
        for(var i = 0; i < $inputs.length;i++)
        {
            //checa se o input está vazio
            if($($inputs[i]).val().length === 0 && $($inputs[i]).attr('name') == 'nome')
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
        req.open("POST","/contatos/doAdd",true);

        req.onreadystatechange = function () {

            if(this.readyState === 4 && this.status === 200)
            {
                var response = this.response;
                response = $.parseJSON(response);

                Agenda.showError(response.msg,'Sucesso');

            }
        };
        req.send(formData);
    },

    toPopulateHTML : function () {

        $.get('/contatos/getDataToManagement',function (data) {
            var returnJSON = $.parseJSON(data);

            $('#contentResult').load('/contatos/manage');

        });

    },

    events : function() {

        $('#cadastrar').click(function () {
            Agenda.formValidation('modal-body')
        });

        $('#gerenciar').click(function () {
            console.log("clicou em gerenciar");
            Agenda.toPopulateHTML();

        });

    }
}