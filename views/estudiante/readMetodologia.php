<?php require 'views/estudiante/header.php'
?>
<?php 
            //$arreglo = [];
            require_once 'models/Metodologia.php';
            foreach($this->metodologias as $row){
                $metodologias = new Metodologia();
                $metodologias = $row;
                //array_push($arreglo,$metodologias);
            }
            
?>

<!-- INICIO DEL CONTENIDO PRINCIPAL -->
<div class="container">
    <h3><i class="far fa-bookmark"></i>&nbsp; Metodologia</h3>
    <hr>
    <br>
    <div class="form-group">
        <label> Nombre</label>
        <input type="text" id="nombre" REQUIRED style=" width: 400px; height: 30px;" name="Nombre"  class="form-control"
            placeholder="Escribe el nombre" value="<?php echo $metodologias->nombre?>">

    </div>
    
    <div class="form-group">
        <label>Descripción</label>
        <textarea name="descripcion" type="text" id="Descripcion" required class="form-control" value=""><?php echo $metodologias->descripcion?></textarea>

    </div>
    <div class="form-group">
        <label> Fuentes</label>
        <ul class="list-group">
        <li class="list-group-item active">Fuentes</li>
        <?php 
           require_once 'libs/database.php';
           $this->db = new Database();
           $query_fuentes_estudiante = $this->db->connect()->query("SELECT * FROM fuentes WHERE IdMetodologia = '$metodologias->id'");
           while($row_fuentes = $query_fuentes_estudiante->fetch()) {
             $item = $row_fuentes['Id'];
             $item = $row_fuentes['link'];
             $item = $row_fuentes['IdMetodologia'];
           
                //array_push($arreglo,$metodologias);
        ?>
        
       
        <li class="list-group-item"> <a href="<?php echo $row_fuentes['link']?>" target="_blank"><?php echo $row_fuentes['link']; ?></a></li>
       
     
            <?php }?>
            </ul>

    </div>
</div>
<!-- FIN  DEL CONTENIDO PRINCIPAL -->

<?php require_once "views/estudiante/footer.php"?>
<script src='<?php echo constant('URL');?>resources/js/autosize.min.js'></script>
<script>
autosize(document.querySelectorAll('#Descripcion'));
</script>