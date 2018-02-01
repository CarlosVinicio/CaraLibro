$(document).ready(function () {


    $.ajax({
        type: "GET",
        url: "coger-correo.php",
        success: function (datos) {
            $('#correo').text(datos)
        }
    })

    $(".campo").click(function () {
        if ($(this).parent().next().hasClass('oculto')) {
            $(this).removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up')
            $(this).parent().next().removeClass('oculto').addClass('visible')
        } else {
            $(this).removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down')
            $(this).parent().next().removeClass('visible').addClass('oculto')
        }

    })

    $("#modificar").click(function () {

        var errores = "";
        var validacion = true
        var contrasennaIntroducida = $('#contrasenna-actual').val()

        if ($("#cambiar-correo").val().length > 40) {
            errores += 'El email supera los 40 caracteres';

            //alert('El email supera los 40 caracteres')
            validacion = false
        } else if ($("#cambiar-correo").val().length != 0) {
            if ($("#cambiar-correo").val().match(/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i)) {
                var correo = $("#cambiar-correo").val()
                $.ajax({
                    type: "GET",
                    url: "comprobarCorreo.php",
                    async: false,
                    data: "correo=" + correo,
                    success: function (correo) {


                        if (correo) {
                            errores += 'Correo ya registrado, prueba con otro<br>';
                            // alert('Correo ya registrado, prueba con otro')
                            validacion = false


                        }


                    }
                })
            } else {
                errores += 'Está intentando ingresar un email inválido<br>';
                //alert('Está intentando ingresar un email inválido')
                validacion = false
            }
        }
        //---------------- modificado por María -------------------------------------------
        var contrasennaNueva1 = $('#contrasenna-nueva1').val()
        var contrasennaNueva2 = $('#contrasenna-nueva2').val()

        if (contrasennaIntroducida.length > 0) {
            $.ajax({
                type: "GET",
                url: "comprobarContrasenna.php",
                async: false,
                    //data: "contrasenna" + contrasennaIntroducida,
                    data: {
                        contrasenna: contrasennaIntroducida
                    },
                    success: function (contrasenna) {
                        console.log('vuelve' + contrasenna);
                        var validacionAjax = contrasenna
                        if (validacionAjax == 0) {
                            errores += "La contraseña actual no es correcta<br>";
                            //alert("La contraseña actual no es correcta")
                            validacion = false;
                        } else {
                            if (contrasennaNueva1.length > 0 ) {
                                if (contrasennaNueva1.length > 30) {
                                    errores += 'La contraseña supera los 20 caracteres<br>';
                                    // alert('La contraseña supera los 20 caracteres')
                                    validacion = false;
                                } else if (!contrasennaNueva1.match(/(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/)) {

                                    errores += 'La contraseña debe contener almenos: una mayuscula, una minuscula, un número, que la longitud sea como minimo 6 caracteres<br>';
                                    //alert('La contraseña debe contener almenos: una mayuscula, una minuscula, un número, que la longitud sea como minimo 6 caracteres')
                                    validacion = false;
                                } else if (contrasennaNueva1 != contrasennaNueva2) {
                                    errores += 'La contraseña nueva no coincide<br>';
                                    validacion = false;
                                }
                            }else{
                                errores += 'Por favor, introduzca la nueva contraseña';
                                validacion = false;
                            }
                        }
                    }
                
            })
        } else {
            errores += 'La contraseña actual es incorrecta';
            validacion = false;
        }
        //---------------- modificado por carlos -------------------------------------------

        if (validacion) {
            var arrayCampos = []
            $(".input").each(function (index) {
                if ($(this).val().length == 0) {
                    arrayCampos[index] = ""
                } else {
                    arrayCampos[index] = $(this).val()
                }

            })
            var envioArray = JSON.stringify(arrayCampos)

            $.ajax({
                type: "GET",
                url: "modificar-datos2.php",
                data: "datos=" + envioArray,
                success: function (datos) {

                }
            })
        }
        // ------------------------- fin modificacion carlos ------------------------------------------------------------

        if (errores == "" && $('#cambiar-correo').val().length > 0 || errores == "" && contrasennaNueva1.length > 0 || errores == "" && contrasennaNueva2.length > 0) {
            $("#errores-privacidad").html('<div class="alert alert-success"><strong> ' + 'Cambios realizados correctamente' + '</strong> </div>');
            setTimeout(function () {
                location.reload();
            }, 3000);

        } else {

            if (errores != '') {
                $("#errores-privacidad").html('<div class="alert alert-danger"><strong> ' + errores + '</strong> </div>');

            }
        }

    })
})
