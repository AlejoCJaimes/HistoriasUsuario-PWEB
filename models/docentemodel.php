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
    //mostrar metodologias
    function loadMetodologias() {
      require_once 'models/Metodologia.php';

        $items = [];
        $aleatorio = 0;
      try {
        $query = $this->db->connect()->query("SELECT * FROM metodologia");
        while($row = $query->fetch()) {
          $aleatorio++;
          $item = new Metodologia();
          $item->id = $row['Id'];
          $item->nombre = $row['Nombre'];
          //$aleatorio = rand(1,70);
          if ($aleatorio > 0 && $aleatorio <=4) {
            $item->bg_color = "primary";
          } elseif ($aleatorio > 4 && $aleatorio <=8) {
            $item->bg_color = "warning";
          } elseif ($aleatorio >8 && $aleatorio <=12) {
            $item->bg_color = "success";
          }elseif ($aleatorio > 12 && $aleatorio <=16) {
            $item->bg_color = "danger";
          }elseif ($aleatorio > 16 && $aleatorio <=20) {
            $item->bg_color = "dark";
          }elseif ($aleatorio > 20 && $aleatorio <=24) {
            $item->bg_color = "info";
          }elseif ($aleatorio > 24) {
            $item->bg_color = "secondary";
          }
          array_push($items,$item);
        }
        //var_dump($nombre_metodologia);
        return $items;
      } catch(PDOException $e){
        return false;
      }
    }
    function insertarMetodologia($datos){
      try{
        $nombreMetodologia = $datos['nombre'];
        $fuenteArray = $datos['fuente'];
        $IdMetodologia = 0; //Variable que guarda el Id de la metodología en su consulta

        //Consulta para insertar una nueva metodología
        $query_1 = $this->db->connect()->prepare('INSERT INTO metodologia (Nombre, Descripcion) VALUES( :nombre, :descripcion)');
        $query_1->execute(['nombre' => $datos['nombre'], 'descripcion' => $datos['descripcion']]);

        //Consulta para obtener el Id de la metodología
        $query_2 = $this->db->connect()->query("SELECT Id FROM metodologia WHERE nombre = '$nombreMetodologia' Limit 1");
        while($row = $query_2->fetch()){
          $IdMetodologia = $row['Id'];            
        }

        //Consulta para insertar las fuentes escojidas por el usuario
        for($i=0; $i< count($fuenteArray); $i++){
          if($fuenteArray[$i] != ""){
            $query_3 = $this->db->connect()->prepare('INSERT INTO fuentes (link, IdMetodologia) VALUES( :link, :idMetodologia)');
            $query_3->execute(['link' => $fuenteArray[$i], 'idMetodologia' => $IdMetodologia]);
          }
        }

        return true;
      }catch(PDOException $e){
        return false;
      }
    }
    public function getByIdMetodologia($id){
      require_once 'models/Metodologia.php';
      $array = [];
      
      
      try{
          //$query->execute(['correo_usuario' => $id]);
          $query = $this->db->connect()->query("SELECT * FROM metodologia WHERE Id = '$id';");
          while($row = $query->fetch()){
            $item = new Metodologia();
              $item->id = $row['Id'];
              $item->nombre = $row['Nombre'];
              $item->descripcion = $row['Descripcion'];
              array_push($array,$item);
          }  
        // var_dump($array);
         
          return $array;
      }catch(PDOException $e){
          return null;
      }
  }
  public function getByIdFuentes($id){
    require_once 'models/Metodologia.php';
    $array = [];
    try{
      //$query->execute(['correo_usuario' => $id]);
     /* $query = $this->db->connect()->query("SELECT * FROM metodologia WHERE Id = '$id';");
      while($row = $query->fetch()){
          $id =$row['Id'];
      }  */
      $query_2 = $this->db->connect()->query("SELECT * FROM fuentes WHERE IdMetodologia = '$id';");
      while ($row_2 = $query_2->fetch()) {
        $items= new Metodologia();
          $items->id_fuentes = $row_2['Id']; 
          $items->link = $row_2['link'];
          array_push($array,$items);
        } 
      // var_dump($array);
       return $array;
    }catch(PDOException $e){
        return null;
    }
}

  public function updateMetodologia($datos) {
    $IdMetodologia = 0;
    try{
      $Id = $datos['id'];
      $nombreMetodologia = $datos['nombreMetodologia'];
      $descripcion = $datos['descripcionMetodologia'];
      $fuenteArray = $datos['fuente'];
      $cantidadFuentes = count($fuenteArray);
      $longitud = $datos['longitud'];
      $IdMetodologias =[];
      $query_1 = $this->db->connect()->prepare("UPDATE `metodologia` SET `Nombre` =:nombre, `Descripcion` =:descripcion WHERE `metodologia`.`Id` = '$Id'");
      $query_1->execute(['nombre' =>$nombreMetodologia,'descripcion' => $descripcion]);
      if ($longitud == $cantidadFuentes ) {
       
       $delete= $this->db->connect()->prepare("DELETE FROM `fuentes` WHERE IdMetodologia =:id");
       $delete->execute(['id' => $Id]);
        //Consulta para insertar las fuentes escojidas por el usuario
        for($i=0; $i<$cantidadFuentes; $i++){
          if($fuenteArray[$i] != ""){
            $query_3 = $this->db->connect()->prepare('INSERT INTO fuentes (link, IdMetodologia) VALUES( :link, :idMetodologia)');
            $query_3->execute(['link' => $fuenteArray[$i], 'idMetodologia' => $Id]);
          }
        }
      }
    
    return true;
    }catch(PDOException $e){
      return false;
    }
  }

  public function update_Fuentes($datos) {
      $Id = $datos['id'];
      $fuentes = $datos['fuentes'];
      $cantidadFuentes = count($fuentes);
      try {
        for ($i=1; $i<=$cantidadFuentes; $i++) { 
          if ($fuentes[$i] != "") {
            $insert_nuevas_fuentes = $this->db->connect()->prepare('INSERT INTO fuentes (link,IdMetodologia) VALUES ( :link, :idMetodologia)');
            $insert_nuevas_fuentes->execute(['link' => $fuentes[$i], 'idMetodologia' => $Id ]);
          }
          
        }
        
        return true;
      } catch (PDOException $e) {
        return false;
      }

  }

  public function eliminarFuentes($datos) {
    $idfuente = $datos['id_fuente'];
    //buscar idLink
    try {
      
      $delete= $this->db->connect()->prepare("DELETE FROM `fuentes` WHERE Id =:idfuente");
      $delete->execute(['idfuente' => $idfuente]);
      return true;
    } catch (PDOException $e) {
      return false;
    }
    
    
  }

  public function deleteMetodologia($datos) {
      $idMetodologia = $datos['id'];
      try {
        $delete= $this->db->connect()->prepare("DELETE FROM `metodologia` WHERE Id =:idMetodologia");
        $delete->execute(['idMetodologia' => $idMetodologia]);
        return true;
      } catch (PDOException $e) {
        return false;
      }
  }

}
?>