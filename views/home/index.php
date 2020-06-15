<body>
  <header>
  <?php require 'views/home/header.php'?>
   <!-- Icono -->
   <link rel="icon" href="<?php echo constant('URL');?>resources/img/logo.png">
</header>

<!--==========================
  About Section
  ============================-->
  <section id="about">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title"> Acerca de </h3>
          <div class="section-title-divider"></div>
          <p class="section-description">Si no sabes lo que es una historia de usuario, en esta sección te lo resumimos.</p>
          <h3 class="section-description">¿Qué es una historia de usuario?</h3>
          <h4 class="section-description text-justify">Una historia de usuario es la unidad de trabajo más pequeña de un marco ágil. Es un objetivo final, no una función, expresado desde la perspectiva del usuario del software.</h4>
          <h3 class="section-description">Propósito</h3>
          <h4 class="section-description text-justify"> El propósito de una historia de usuario es articular cómo entregará un trabajo específico un valor particular al cliente. Se debe tener en cuenta que los "clientes" no tienen que ser usuarios finales externos en el sentido tradicional, también pueden ser clientes internos o colegas dentro de una organización que dependen del equipo.</h4>
          <h3 class="section-description">¿Por qué crear historias de usuario?</h3>        
          <h4 class="section-description text-justify"> El crear historias de usuario trae muchos beneficios, algunos se presentan a continuación.</h4>
          <h4 class="section-description"> 1. Las historias mantienen el foco en el usuario: Una lista de tareas pendientes mantiene al equipo centrado en las tareas que necesitan ser marcadas, pero una colección de historias mantiene al equipo centrado en la resolución de problemas para usuarios reales.</h4>
          <h4 class="section-description"> 2. Las historias permiten la colaboración: Con el objetivo final definido, el equipo puede trabajar en conjunto para decidir cuál es la mejor manera de servir al usuario y alcanzar ese objetivo.</h4>
          <h4 class="section-description"> 3. Las historias impulsan soluciones creativas: Las historias animan al equipo a pensar de manera crítica y creativa sobre la mejor manera de resolver un objetivo final.</h4>
          <h4 class="section-description"> 4. Las historias crean impulso: Con cada historia que pasa, el equipo de desarrollo disfruta de un pequeño desafío y una pequeña victoria, lo que fomenta el impulso.</h4>
        </div>

      </div>
    </div>
  </section>

  <!--==========================
  Roles Section
  ============================-->
  <section id="testimonials">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">Roles </h3>
          <div class="section-title-divider"></div>
          <p class="section-description">En esta sección podrás encontrar la información con respecto a los roles del sistema, y una breve descripción de lo que cada uno es capaz de hacer.</p>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <div class="profile">
            <div class="pic"><img src="<?php echo constant('URL');?>EstiloHome/img/Admin.jpg" alt=""></div>
            <h4>Administrador</h4>
            </div>
        </div>
        <div class="col-md-9">
          <div class="quote">
            <b><img src="<?php echo constant('URL');?>EstiloHome/img/quote_sign_left.png" alt=""></b> El administrador en el sistema, es el encargado de gestionar todos los usuarios, los programas universitarios, y los estados, este es capaz de editar y de eliminarlos.<small><img src="img/quote_sign_right.png" alt=""></small>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-9">
          <div class="quote">
            <b><img src="<?php echo constant('URL');?>EstiloHome/img/quote_sign_left.png" alt=""></b> El docente es el encargado de crear los proyectos, proyectos los cuales contienen la metodología a aplicar y el grupo al que le corresponde. Tanto la metodología, la creación de grupos y la asignación de estudiantes, también le corresponde a este rol. <small><img src="img/quote_sign_right.png" alt=""></small>
          </div>
        </div>
        <div class="col-md-3">
          <div class="profile">
            <div class="pic"><img src="<?php echo constant('URL');?>EstiloHome/img/Docente.jpg" alt=""></div>
            <h4>Docente</h4>
          </div>
        </div>
      </div>

      
      <div class="row">
        <div class="col-md-3">
          <div class="profile">
            <div class="pic"><img src="<?php echo constant('URL');?>EstiloHome/img/Estudiante.jpg" alt=""></div>
            <h4>Estudiante</h4>
            </div>
        </div>
        <div class="col-md-9">
          <div class="quote">
            <b><img src="<?php echo constant('URL');?>EstiloHome/img/quote_sign_left.png" alt=""></b> El estudiante es el encargado de definir la fase, el objetivo de esta, se encarga de la definción del módulo, posteriormente puede proceder a la creación de la historia de usuario, después define la actividad, y por último, define el recurso . <small><img src="img/quote_sign_right.png" alt=""></small>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!--==========================
  Contact Section
  ============================-->
  <section id="contact">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">Contacto</h3>
          <div class="section-title-divider"></div>
          <p class="section-description">En caso de que desees ponerte en contacto con alguno de los desarrolladores, puedes enviar un mensaje a cualquiera de los tres correos electrónicos que aparecen a continuación.</p>
       
          <div class="info">
          <h4 class="section-description">Juan Alejandro Carrillo Jaimes: 📧 Jcarrillo13@udi.edu.co.</h4>
          <h4 class="section-description">Jhoan Manuel Rangel Mariño: 📧 Jrangel7@udi.edu.co.</h4>
          <h4 class="section-description">Juan Camilo Valencia Silva: 📧 Jvalencia2@udi.edu.co.</h4>
      
      </div>
    </div>
  </section>
 
 <footer>
 <?php require_once 'views/home/footer.php'?>
 </footer>

