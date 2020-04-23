<?php
require_once 'libs/database.php';

class DocenteModel extends Model {


    public function __construct() {
        parent::__construct();
    }

    public function loadData($correo) {

      try {
        //SELECT * FROM estudiante JOIN usuario ON estudiante.IdUsuario = usuario.Id WHERE correo_usuario = "_juanalejo2010@gmail.com"
        $query_1 = $this->db->connect()->query("SELECT * FROM `docente` WHERE correo_usuario = '$correo' Limit 1;");

        while($row_1 = $query_1->fetch()){
            $idUsuario = $row_1['Id'];
        }

      } catch (PDOException $e) {
          return $e;
      }


    }

    function loadPerfil($correo) {

      //statement return IDadmin
      require_once 'models/Users.php';
      $item = new Users();
        try {



          $items = [];
          $this->db = new Database();
          $query_1 = $this->db->connect()->query("SELECT ID from usuario WHERE usuario.correo_usuario = '$correo'");

            while($row = $query_1->fetch()){
                 $IdAdmin = $row['ID'];
            }

          $query_2 = $this->db->connect()->query("SELECT * FROM docente WHERE docente.IdUsuario = '$IdAdmin' ");


            while($row_2 = $query_2->fetch()){
              //retornar datos

              $item->cedula = $row_2['CedulaDocente'];
              $item->id_documento = $row_2['IdTipoDocumento'];
              $item->nombre = $row_2['NombreDocente'];
              $item->apellido = $row_2['ApellidoDocente'];
              $item->titulo_docente = $row_2['TituloDocente'];
              $IdDocumento = $row_2['IdTipoDocumento'];

              //statement return NameDocument


            }
            $query_3 = $this->db->connect()->query("SELECT NombreDocumento FROM tipodocumento WHERE tipodocumento.Id = '$IdDocumento' ");

              while($row_3 = $query_3->fetch()){
                $item->tipo_documento = $row_3['NombreDocumento'];

                array_push($items,$item);
              }


          return $items;
        } catch (PDOException $e) {
            return $e;
        }


    }

    public function updatePerfil($datos) {
      try{
        $cedula = $datos['CedulaDocente'];
        $query = $this->db->connect()->prepare("UPDATE `docente` SET NombreDocente=:nombre,ApellidoDocente=:apellido WHERE CedulaDocente = '$cedula';");
        $query->execute(['nombre' => $datos['NombreDocente'], 'apellido' => $datos['ApellidoDocente']]);

        return true;
      }catch(PDOException $e){
        return false;
      }


    }
    function updateClave($datos) {

        $correo = $datos['correo_usuario'];

        $clave = $datos['clave_usuario'];

        try {
            $query = $this->db->connect()->prepare("UPDATE `usuario` SET clave_usuario=:clave_usuario WHERE correo_usuario = '$correo';");
            $query->execute(['clave_usuario' => $clave]);
            return true;
        } catch(PDOException $e){
          return false;
        }


    }

    function insertarMetodologia($datos){
      try{
        $query_1 = $this->db->connect()->prepare('INSERT INTO metodologia (Nombre, Descripcion) VALUES( :nombre, :descripcion)');
        $query_1->execute(['nombre' => $datos['nombre'], 'descripcion' => $datos['descripcion']]);

        return true;
      }catch(PDOException $e){
        return false;
      }
    }

}
?>
