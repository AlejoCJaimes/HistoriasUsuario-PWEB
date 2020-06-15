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
      ///////////////////////////
       // INICIO SENTENCIAS SQL PARA METODOLOGÍAS
       //////////////////////////
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
        ///////////////////////////
       // FIN SENTENCIAS SQL PARA METODOLOGIAS
       //////////////////////////
      

        ///////////////////////////
       // INICIO SENTENCIAS SQL PARA GRUPOS
       //////////////////////////
       public function loadEstudiantes() {
        require_once 'models/Estudiante.php';

        $query = $this->db->connect()->query("SELECT e.Id AS 'Id', e.CedulaEstudiante AS 'CedulaEstudiante', e.NombreEstudiante as 'NombreEstudiante', e.ApellidoEstudiante as 'ApellidoEstudiante', e.NumeroSemestre as 'NumeroSemestre', e.CodigoPrograma as 'CodigoPrograma', r._status as 'estado' 
        FROM estudiante AS e
        JOIN usuario AS u ON e.IdUsuario = u.Id
        JOIN rolusuario AS r ON r.IdUsuario = u.Id
        WHERE r._status !='Pendiente'");
        
        $items = [];
        try {
          while ($row =$query->fetch()) {
            $item = new Estudiante();
            $item->id = $row['Id'];
            $item->CedulaEstudiante = $row['CedulaEstudiante'];
            $item->NombreEstudiante = $row['NombreEstudiante'];
            $item->ApellidoEstudiante = $row['ApellidoEstudiante'];
            $item->CodigoPrograma = $row['CodigoPrograma'];
            $codigoprograma = $row['CodigoPrograma'];
            $item->NumeroSemestre = $row['NumeroSemestre'];
            $item->estado = $row['estado'];

           $query_2 = $this->db->connect()->query("SELECT Nombre FROM programa where codigo = '$codigoprograma'"); 
           
            while ($row_2 =$query_2->fetch()) {
              $item->NombrePrograma = $row_2['Nombre'];
            
            }
            array_push($items,$item);
            }
          
            return $items;
      
        } catch (PDOException $e) {
          return $e;
        }
        
      }

      //Agregar un nuevo grupo a la base de datos
      public function insertarGrupo($datos){
        try {
          $nombre = $datos['nombre'];
          $idGrupo = 0;
          $query_1 = $this->db->connect()->prepare("INSERT INTO `grupo`(`nombre`) VALUES (:nombre)");
          $query_1->execute(['nombre' => $datos['nombre']]);
          
          $query_2 = $this->db->connect()->query("SELECT Id FROM grupo WHERE nombre = '$nombre' Limit 1");
          while($row = $query_2->fetch()){
            $idGrupo = $row['Id'];            
          }

          for($i=0; $i < count($datos['estudiantes']); $i++){
            $estudiante = $datos['estudiantes'][$i];
            $query_4 = $this->db->connect()->query("SELECT Id FROM estudiante WHERE CedulaEstudiante = '$estudiante' Limit 1");
            while($row = $query_4->fetch()){
              $idEstudiante = $row['Id'];            
            }

            $query_3 = $this->db->connect()->prepare("INSERT INTO `grupoestudiante` (`IdGrupo`, `IdEstudiante`) VALUES (:idGrupo, :idEstudiante);");                        
            $query_3->execute(['idGrupo' => $idGrupo, 'idEstudiante' => $idEstudiante]);
          }

          return true;
        } catch (PDOException $ex) {
          return false;
        }
      }


      public function update_Grupo($datos) {
        //castear datos
        $id_grupo = $datos['id_grupo'];
        //obtener fecha
        $datetime = new DateTime(null, new DateTimeZone('America/Bogota'));
  
        try {
          $update_grupo = $this->db->connect()->prepare("UPDATE `grupo` SET `nombre` =:nombre, `FechaActualizacion` =:fecha  WHERE `grupo`.`Id` = '$id_grupo'");
          $update_grupo->execute(['nombre' => $datos['nombre'], 'fecha' => $datetime->format('Y-m-d H:i:s (e)')]);
          return true;
        } catch (PDOException $e) {
          return $e;
        }
      }


      public function update_estudiante_x_Grupo($datos) {
        //castear datos
        $id_estudiante = $datos['id_estudiante'];
        $id_grupo = $datos['id_grupo'];

        //statement SQL 

        try {
          $insert_grupo = $this->db->connect()->prepare("INSERT INTO `grupoestudiante` (`IdGrupo`, `IdEstudiante`) VALUES (:idGrupo, :idEstudiante);");                        
          $insert_grupo->execute(['idGrupo' => $id_grupo, 'idEstudiante' => $id_estudiante]);
          return true;
        } catch (PDOException $e) {
          return $e;
        }
      }

      public function delete_estudiante_x_Grupo($datos) {
        //castear datos
        $id_estudiante = $datos['id_estudiante'];
        $id_grupo = $datos['id_grupo'];

        //statement SQL 

        try {
          $delete_grupo = $this->db->connect()->prepare("DELETE FROM `grupoestudiante` WHERE IdEstudiante =:idEstudiante");                        
          $delete_grupo->execute(['idEstudiante' => $id_estudiante]);
          return true;
        } catch (PDOException $e) {
          return $e;
        }
      }

      public function delete_Grupo($datos) {
        //castear datos
        $id_grupo = $datos['id_grupo'];

        //statement SQL 

        try {
          $delete_grupo = $this->db->connect()->prepare("DELETE FROM `grupo` WHERE Id =:idgrupo");                        
          $delete_grupo->execute(['idgrupo' => $id_grupo]);
          return true;
        } catch (PDOException $e) {
          return $e;
        }
      }
      ///////////////////////////////////
       // FIN SENTENCIAS SQL PARA GRUPOS
       /////////////////////////////////


       ////////////////////////////////
       //SENTENCIAS SQL PARA PROYECTOS
       ///////////////////////////////
      
       //Agregar un nuevo proyecto a la base de datos
      public function insertarProyecto($datos){
        try{
          $correo = $datos['correo'];
          $idUsuario = 0;
          $idDocente = 0;
          
          //Consultas para obtener el Id del docente
          $query_1 = $this->db->connect()->query("SELECT Id FROM usuario WHERE correo_usuario = '$correo' Limit 1");
          while($row = $query_1->fetch()){
            $idUsuario = $row['Id'];            
          }
          $query_2 = $this->db->connect()->query("SELECT Id FROM docente WHERE IdUsuario = '$idUsuario' Limit 1");
          while($row = $query_2->fetch()){
            $idDocente = $row['Id'];            
          }
          //Consulta para insertar una nueva metodología
          $query_3 = $this->db->connect()->prepare("INSERT INTO `proyecto`(`NombreProyecto`,`FechaFin`, `IdDocente`, `IdMetodologia`, `IdEstado`) VALUES (:nombreProyecto,:fechaFin,:idDocente,:idMetodologia,:idEstado)");
          $query_3->execute(['nombreProyecto' => $datos['nombreProyecto'], 'fechaFin' => $datos['fechaFin'], 'idDocente' => $idDocente, 'idMetodologia' => $datos['idMetodologia'], 'idEstado' => $datos['idEstado']]);
          
          $nombreProyecto = $datos['nombreProyecto'];

          $query_4 = $this->db->connect()->query("SELECT Id FROM proyecto WHERE NombreProyecto = '$nombreProyecto' Limit 1");
          while($row = $query_4->fetch()){
            $idProyecto = $row['Id'];            
          }

          $query_3 = $this->db->connect()->prepare("INSERT INTO `grupoproyecto`(`IdGrupo`, `IdProyecto`) VALUES (:idGrupo,:idProyecto)");
          $query_3->execute(['idGrupo' => $datos['grupo'], 'idProyecto' => $idProyecto]);

          return true;
        }catch(PDOException $e){
          return false;
        }
      }

      
      public function loadGrupo() {
        require_once 'models/Grupo.php';

        $query = $this->db->connect()->query("SELECT Id, nombre,  DATE_FORMAT(FechaCreacion,' %d-%M-%Y %h:%i %p') as 'fecha' FROM grupo ");
        
        $items = [];
        try {
          while ($row =$query->fetch()) {
            $item = new Grupo();
            $item->id = $row['Id'];
            $item->nombre = $row['nombre'];
            $item->fecha_creacion = $row['fecha'];
            array_push($items,$item);
          }
          
            return $items;
      
        } catch (PDOException $e) {
          return $e;
        }
        
      }

      public function loadEstudiantesGrupo($id_grupo) {
        require_once 'models/Estudiante.php';

        $query = $this->db->connect()->query("SELECT e.Id AS 'Id', e.CedulaEstudiante AS 'CedulaEstudiante', e.NombreEstudiante as 'NombreEstudiante', e.ApellidoEstudiante as 'ApellidoEstudiante', e.NumeroSemestre as 'NumeroSemestre', e.CodigoPrograma as 'CodigoPrograma', r._status as 'estado' 
        FROM estudiante AS e
        JOIN usuario AS u ON e.IdUsuario = u.Id
        JOIN rolusuario AS r ON r.IdUsuario = u.Id
        JOIN grupoestudiante as gp ON gp.IdEstudiante = e.Id
        WHERE gp.IdGrupo = '$id_grupo'");
        
        $items = [];
        try {
          while ($row =$query->fetch()) {
            $item = new Estudiante();
            $item->id = $row['Id'];
            $item->CedulaEstudiante = $row['CedulaEstudiante'];
            $item->NombreEstudiante = $row['NombreEstudiante'];
            $item->ApellidoEstudiante = $row['ApellidoEstudiante'];
            $item->CodigoPrograma = $row['CodigoPrograma'];
            $codigoprograma = $row['CodigoPrograma'];
            $item->NumeroSemestre = $row['NumeroSemestre'];
            $item->estado = $row['estado'];

           $query_2 = $this->db->connect()->query("SELECT Nombre FROM programa where codigo = '$codigoprograma'"); 
           
            while ($row_2 =$query_2->fetch()) {
              $item->NombrePrograma = $row_2['Nombre'];
            
            }
            array_push($items,$item);
            }
          
            return $items;
      
        } catch (PDOException $e) {
          return $e;
        }
        
      }

      public function getGrupo($id_grupo) {
        require_once 'models/Grupo.php';

        $query = $this->db->connect()->query("SELECT Id, nombre,  DATE_FORMAT(FechaCreacion,' %d-%M-%Y %h:%i %p') as 'fecha' FROM grupo WHERE Id = '$id_grupo' ");
        
        $items = [];
        try {
          while ($row =$query->fetch()) {
            $item = new Grupo();
            $item->id = $row['Id'];
            $item->nombre = $row['nombre'];
            $item->fecha_creacion = $row['fecha'];
            array_push($items,$item);
          }
          
            return $items;
      
        } catch (PDOException $e) {
          return $e;
        }
      }

      public function loadProyectos() {

        require_once 'models/Proyecto.php';

        $query = $this->db->connect()->query("SELECT * FROM proyecto ");
        $items = [];

        try {
          while ($row =$query->fetch()) {
            $item = new Proyecto();
            $item->Id = $row['Id'];
            $item->NombreProyecto = $row['NombreProyecto'];
            $item->FechaCreacion = $row['FechaCreacion'];
            $item->FechaFin = $row['FechaFin'];
            $item->FechaActualizacion = $row['FechaActualizacion'];
            $item->IdDocente = $row['IdDocente'];
            $item->IdMetodologia = $row['IdMetodologia'];
            $item->IdEstado = $row['IdEstado'];
            array_push($items,$item);
          }
          
            return $items;
      
        } catch (PDOException $e) {
          return $e;
        }
      }

      public function cargarProyectoIndex() {

        $query = $this->db->connect()->query("SELECT COUNT(*) AS 'numero_proyecto' FROM proyecto ");
        $item = 0;
        try {
          while ($row =$query->fetch()) {
            $item = $row['numero_proyecto'];
          }
          
            return $item;
      
        } catch (PDOException $e) {
          return $e;
        }
      }

      public function cargarGrupoIndex() {
      
        $query = $this->db->connect()->query("SELECT COUNT(*) AS 'numero_grupo' FROM grupo");
        $item = 0;
        try {
          while ($row =$query->fetch()) {
            $item = $row['numero_grupo'];
          }
          
            return $item;
      
        } catch (PDOException $e) {
          return $e;
        }
      }

      public function cargarMetodologiaIndex() {
        $query = $this->db->connect()->query("SELECT COUNT(*) AS 'numero_metodologia' FROM metodologia");
        $item = 0;
        try {
          while ($row =$query->fetch()) {
            $item = $row['numero_metodologia'];
          }
          
            return $item;
      
        } catch (PDOException $e) {
          return $e;
        }
      }


      public function getProyecto($id_proyecto) {
        require_once 'models/Proyecto.php';
        $query = $this->db->connect()->query("SELECT p.Id as 'Id', p.NombreProyecto as 'NombreProyecto', DATE_FORMAT(p.FechaCreacion,'%Y-%M-%d') as 'FechaCreacion', 
        DATE_FORMAT(p.FechaActualizacion,'%Y-%M-%d') as 'FechaActualizacion',  DATE_FORMAT(p.FechaFin,'%Y-%m-%d') as 'FechaFin',
        p.IdDocente as 'IdDocente', p.IdMetodologia as 'IdMetodologia', p.IdEstado as 'IdEstado', CONCAT(d.NombreDocente,' ',d.ApellidoDocente) as 'NombreDocente',
        m.Nombre as 'Metodologia', e.Nombre AS 'Estado', (SELECT g.nombre 
        FROM grupo as g JOIN grupoproyecto as gp ON g.Id = gp.IdGrupo 
        WHERE gp.IdProyecto = '$id_proyecto') as 'Grupo'
        FROM proyecto as p
        JOIN docente as d ON d.Id = p.IdDocente
        JOIN metodologia as m ON m.Id = p.IdMetodologia
        JOIN estado as e ON e.Id = p.IdEstado
        WHERE p.Id = '$id_proyecto'
        GROUP BY p.id,p.NombreProyecto,p.FechaCreacion,p.FechaActualizacion,p.IdMetodologia,p.IdEstado, p.IdDocente");
        $items = [];
        try {
          while ($row =$query->fetch()) {
            $item = new Proyecto();
            $item->Id = $row['Id'];
            $item->NombreProyecto = $row['NombreProyecto'];
            $item->FechaCreacion = $row['FechaCreacion'];
            $item->FechaFin = $row['FechaFin'];
            $item->FechaActualizacion = $row['FechaActualizacion'];
            $item->IdDocente = $row['IdDocente'];
            $item->IdMetodologia = $row['IdMetodologia'];
            $item->IdEstado = $row['IdEstado'];
            $item->nombre_docente = $row['NombreDocente'];
            $item->nombre_metodologia = $row['Metodologia'];
            $item->nombre_estado = $row['Estado'];
            $item->nombre_grupo = $row['Grupo'];
            array_push($items,$item);
          }
          
            return $items;
      
        } catch (PDOException $e) {
          return $e;
        }
      }

      public function update_Proyecto($datos) {
        $id_proyecto = $datos['id_proyecto'];
      
        $datetime = new DateTime(null, new DateTimeZone('America/Bogota'));
  
        try {
          $update_grupo = $this->db->connect()->prepare("UPDATE `proyecto` SET `NombreProyecto` =:nombre, `FechaActualizacion` =:fechaActualizacion, `FechaFin` =:fechafin, `IdEstado` =:id_estado   WHERE `proyecto`.`Id` = '$id_proyecto'");
          $update_grupo->execute(['nombre' => $datos['NombreProyecto'], 'fechaActualizacion' => $datetime->format('Y-m-d H:i:s (e)'), 'fechafin' => $datos['fecha_fin'], 'id_estado' => $datos['idEstado']]);
          return true;
        } catch (PDOException $e) {
          return $e;
        }

      }

      public function inactive_proyecto($id_proyecto) {
          $id_proyecto = $id_proyecto['id_proyecto'];
        $datetime = new DateTime(null, new DateTimeZone('America/Bogota'));
        try {
          $update_proyecto = $this->db->connect()->prepare("UPDATE `proyecto` SET `FechaActualizacion` =:fechaActualizacion,`IdEstado` =:id_estado   WHERE `proyecto`.`Id` = '$id_proyecto'");
          $update_proyecto->execute(['fechaActualizacion' => $datetime->format('Y-m-d H:i:s (e)'), 'id_estado' => '7']);
          return true;
        } catch (PDOException $e) {
          return $e;
        }
      }

      public function deleteProyecto($id_proyecto) {
        $id_proyecto = $id_proyecto['id_proyecto'];
        try {
          $delete_proyecto = $this->db->connect()->prepare("DELETE  FROM `proyecto` WHERE `proyecto`.`Id` =:id_proyecto");
          $delete_proyecto->execute(['id_proyecto' => $id_proyecto]);
          return true;
        } catch (PDOException $e) {
          return $e;
        }
      }
      
      ////////////////////////////////
       //FIN SENTENCIAS SQL PARA PROYECTOS
       ///////////////////////////////
}
?>