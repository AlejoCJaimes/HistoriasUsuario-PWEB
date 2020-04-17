<?php
#librerias
require_once 'libs/database.php';
require_once 'controllers/administrador.php';
require_once 'controllers/estudiante.php';

class AccountModel extends Model {

  public function __construct() {
      parent::__construct();
  }


  public function validar_sesion($datos) {

    $correo = $datos['correo_usuario'];
    $clave = $datos['clave_usuario'];
    $valor = 0;

        //statement return loginconfirmation
        try{
          $query_1 = $this->db->connect()->prepare('SELECT * FROM  usuario WHERE correo_usuario = :correo_usuario AND clave_usuario = :clave_usuario');
          /*$query_1 = $this->db->connect()->prepare('INSERT INTO usuario (correo_usuario, clave_usuario) VALUES( :correo_usuario, :clave_usuario)');
          $query_1->execute(['correo_usuario' => $datos['correo_usuario'], 'clave_usuario' => $datos['clave_usuario']]);*/
           $query_1->execute(['correo_usuario'=> $correo, 'clave_usuario'=> $clave]);

           $query_2 = $this->db->connect()->query("select * from usuario u join rolusuario ru on u.id = ru.IdUsuario where u.correo_usuario = '$correo' and u.clave_usuario = '$clave' Limit 1;");
          $estado = 'Pendiente';
          while($row_1 = $query_2->fetch()){
              $estado = $row_1['_status'];
          }

           $row_1 = $query_1->fetch(PDO::FETCH_NUM);
          if ($row_1== true) {
            //echo "MENSAJE_SI";
            if($estado == 'Activo'){
              return true;
            }else{
              return false;
            }
          

         } else {
           return false;
         }
            //$row_2 = $query_2->fetch(PDO::FETCH_NUM);
            //statement 2



          $valor = 1;

      } catch (PDOException $e) {


          return false;
      }



        /*$query_1 = $this->db->connect()->query("SELECT IdRol FROM `rolusuario` JOIN `usuario` ON rolusuario.IdUsuario = usuario.Id

        WHERE usuario.correo_usuario ='$correo_usuario' Limit 1;");

        $query_1->execute([''])
        $row = $query*/


    }
  }

//verificacion de roles.




/*include_once 'models/usuario.php';
require_once('libs/database.php');


class AccountModel extends Model {

  public function __construct() {
      parent::__construct();
  }

  public function userExists($correo_usuario, $clave_usuario) {

    try {

      //statement return loginconfirmation

      $query_1 = $this->db->connect()->prepare('SELECT * FROM  usuario WHERE correo_usuario = :correo_usuario AND clave_usuario = :clave_usuario  ');
      $query_1 = execute(['correo_usuario']=> $correo_usuario, ['clave_usuario']=> $clave_usuario);

      if ($query->rowCount()) {
          return true;
      } else {
         return false;
      }

    } catch (PDOException $e) {
        return false;
    }

  }

  public function setUser($user) {

    //statemet return rol user
    $query_2 = $this->db->connect()->query("SELECT nombre FROM `rol` JOIN `rolusuario` ON rol.id = rolusuario.IdRol

    JOIN `usuario` ON rolusuario.IdUsuario = usuario.Id  WHERE correo_usuario = '$correo_usuario' Limit 1;");
    while($row = $query_2->fetch()){
      $rol = $fila['nombre'];
    }
    //statement return emailuser
    $query_3 = $this->connect()->prepare('SELECT * FROM usuario WHERE correo_usuario = :correo_usuario');
    $query_3->execute(['correo_usuario'=>$correo_usuario]);

    foreach ($query_3 as $currentUser ) {
      $this->correo_usuario= $currentUser['correo_usuario'];

    }


  }

  public function getCorreo() {

      return $this->correo_usuario;
  }

}


*/


?>
