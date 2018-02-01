$(document).ready(function () {

    $.ajax({
        type: "GET",
        url: "coger-datos.php",
        success: function (datos) {
            var arraydatos = JSON.parse(datos);
            $('#nombre').text(arraydatos[0])
            $('#apellido').text(arraydatos[1])
            $('#fecna').text(arraydatos[2])
            $('#sexo').text(arraydatos[3])
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
        if ($('#cambiar-nombre').val().length > 30) {
            //alert('El nombre supera los 20 caracteres')

            errores += 'El nombre supera los 20 caracteres';
            validacion = false
        } else if ($('#cambiar-nombre').val().length != 0 && $('#cambiar-nombre').val().length < 4) {
            //alert('El nombre debe tener minimo 4 letras')

            errores += 'El nombre debe tener minimo 4 letras';
            validacion = false
        }

        if ($('#cambiar-apellido').val().length > 30) {
            //alert('El apellido supera los 20 caracteres')

            errores += 'El apellido supera los 20 caracteres';
            validacion = false
        } else if ($('#cambiar-apellido').val().length != 0 && $('#cambiar-apellido').val().length < 4) {
            //alert('El apellido debe tener minimo 4 letras')

            errores += 'El apellido debe tener minimo 4 letras';
            validacion = false
        }

        if ($('#cambiar-fecha').val().length != 0) {
            if (!isNaN($('#cambiar-fecha').val())) {
                //alert('El campo fecha de nacimiento no puede ser un numero')

                errores += 'El campo fecha de nacimiento no puede ser un numero';
                validacion = false
            } else if (!$('#cambiar-fecha').val().match(/^(0?[1-9]|[12][0-9]|3[01])[\/](0?[1-9]|[1][012])[\/]((19|20)?[0-9]{2})$/)) {
                //alert('El formato de la fecha no es el correcto')

                errores += 'El formato de la fecha no es el correcto';
                validacion = false
            }
        }

        if (validacion) {
            var arrayCampos = []

            $(".input").each(function (index) {
                if (index == 3) {
                    if ($(".inputSexo:radio[name=sexo]:checked").val() == undefined) {
                        arrayCampos[index] = ""
                    } else {
                        arrayCampos[index] = $(".inputSexo:radio[name=sexo]:checked").val()
                    }
                } else {
                    if ($(this).val().length == 0) {
                        arrayCampos[index] = ""
                    } else {
                        arrayCampos[index] = $(this).val()
                    }
                }
            })

            var envioArray = JSON.stringify(arrayCampos)

            $.ajax({
                type: "GET",
                url: "modificar-datos.php",
                data: "datos=" + envioArray,

                success: function (datos) {}
            })
        }


        if (errores == "" && $('#cambiar-nombre').val().length > 0 || errores == "" && $('#cambiar-apellido').val().length > 0 || errores == "" && $('#cambiar-fecha').val().length > 0 || errores == "" && $(".inputSexo:radio[name=sexo]:checked").length > 0) {
            $("#errores-perfil").html('<div class="alert alert-success"><strong> ' + 'Cambios realizados correctamente' + '</strong> </div>');
            setTimeout(function () {
                location.reload();
            }, 2000);

        } else {

            if (errores != '') {
                $("#errores-perfil").html('<div class="alert alert-danger"><strong> ' + errores + '</strong> </div>');

            }
        }

    })




})
