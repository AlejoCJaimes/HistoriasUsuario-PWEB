/*Validaciones Formulario de Registro*/

/*Si los campos son vacíos*/
function validarFormulario () {

    var formulario = document.formularioRegistro;

    if (formulario.clave_usuario.value == "" && formulario.confirmacion_clave.value == "" && formulario.correo_usuario.value == "" ) {
        document.getElementById("alerta").innerHTML = "<p style='color: red' >Los campos no pueden ser vacios. </p>";
        return false;
    } else {

        if (formulario.clave_usuario.value != formulario.confirmacion_clave.value) {
            document.getElementById("alerta").innerHTML =  "<p style='color: red'>  Las contraseñas no coinciden. </p>";
        } else {

            formulario.submit();
            return true;
        }


        //

    }
}
