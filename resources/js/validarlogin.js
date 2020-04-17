
function validarFormulario () {

    var formulario = document.formularioRegistro;

    if (formulario.clave_usuario.value == "" && formulario.correo_usuario.value == "" ) {
        document.getElementById("alerta").innerHTML = "<p style='color: red' >Los campos no pueden ser vacios. </p>";
        return false;
    } else {

            formulario.submit();
            return true;
        }


        //

    }
}
