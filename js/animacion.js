$(document).ready(function () {
    $("#enlace_reg2").hide();
    $("#iniciar_Sesion_form").hide();

    $(".activar_animacion").click(function () {
        $("#grupo__nombre").animate({
            opacity: '0'
        });

        $("#grupo__apellidos").animate({
            top: '-50',
            opacity: '0'
        });
        $("#grupo__codePostal").animate({
            top: '-80',
            opacity: '0'
        });
        $("#grupo__provincia").animate({
            top: '-80',
            opacity: '0'
        });

        $("#grupo__direccion").animate({
            top: '-80',
            opacity: '0'
        });

        $("#grupo__correo").animate({
            top: '-110',
            opacity: '0'
        });

        $("#grupo__pass1").animate({
            top: '-140',
            opacity: '0'
        });

        $("#grupo__pass2").animate({
            top: '-170',
            opacity: '0'
        });

        $("#btn_registrar").animate({
            top: '-170',
            opacity: '0'
        });

        $("#enlace_reg").animate({
            top: '-200',
            opacity: '0'

        });

        $("#emailIS").animate({
            top: '500',
            opacity: '0'

        });
        $("#passIS").animate({
            top: '500',
            opacity: '0'

        });
        $("#btn_entrar").animate({
            top: '500',
            opacity: '0'

        });
        $("#enlace_reg2").animate({
            top: '500',
            opacity: '0'

        });

        setTimeout(() => {

            $("#registrarse_form").hide();
            $("#enlace_reg").hide();

            $("#titulo_form").text('Iniciar Sesion');

            $("#iniciar_Sesion_form").show();
            $("#enlace_reg2").show();

            $("#emailIS").animate({
                top: '0',
                opacity: '0.99'
            });
            $("#passIS").animate({
                top: '0',
                opacity: '0.99'
            });
            $("#btn_entrar").animate({
                top: '0',
                opacity: '0.99'

            });
            $("#enlace_reg2").animate({
                top: '0',
                opacity: '0.99'

            });

        }, 400);
    });

    $(".activar_animacion2").click(function () {
        $("#emailIS").animate({
            top: '500',
            opacity: '0'

        });
        $("#passIS").animate({
            top: '500',
            opacity: '0'

        });
        $("#btn_entrar").animate({
            top: '500',
            opacity: '0'

        });
        $("#enlace_reg2").animate({
            top: '500',
            opacity: '0'

        });

        setTimeout(() => {

            $("#registrarse_form").show();
            $("#enlace_reg").show();

            $("#titulo_form").text('Registrarse');

            $("#iniciar_Sesion_form").hide();
            $("#enlace_reg2").hide();

            $("#grupo__nombre").animate({
                opacity: '0.99'
            });

            $("#grupo__apellidos").animate({
                top: '0',
                opacity: '0.99'
            });
            $("#grupo__codePostal").animate({
                top: '0',
                opacity: '0.99'
            });
            $("#grupo__provincia").animate({
                top: '0',
                opacity: '0.99'
            });

            $("#grupo__direccion").animate({
                top: '0',
                opacity: '0.99'
            });

            $("#grupo__correo").animate({
                top: '0',
                opacity: '0.99'
            });

            $("#grupo__pass1").animate({
                top: '0',
                opacity: '0.99'
            });

            $("#grupo__pass2").animate({
                top: '0',
                opacity: '0.99'
            });

            $("#btn_registrar").animate({
                top: '0',
                opacity: '0.99'
            });

            $("#enlace_reg").animate({
                top: '0',
                opacity: '0.99'

            });

        }, 400);
    });

    $(".activar_animacion3").click(function () {

        $("#registrarse_form").hide();
        $("#enlace_reg").hide();

        $("#titulo_form").text('Iniciar Sesion');

        $("#iniciar_Sesion_form").show();
        $("#enlace_reg2").show();

    });
    $(".activar_animacion4").click(function () {

        $(".activar_animacion").text('Iniciar Sesion');
    });

});