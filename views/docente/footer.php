</div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; JMarios 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Estás seguro que deseas abandonar?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Selecciona "aceptar" si deseas cerrar sesión.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-info" href="<?php echo constant('URL');?>account/logout">Aceptar</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo constant('URL');?>resources/layout_partial/jquery/jquery.min.js"></script>
  <script src="<?php echo constant('URL');?>resources/layout_partial/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo constant('URL');?>resources/layout_partial/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo constant('URL');?>resources/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?php echo constant('URL');?>resources/layout_partial/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo constant('URL');?>resources/js/demo/chart-area-demo.js"></script>
  <script src="<?php echo constant('URL');?>resources/js/demo/chart-pie-demo.js"></script>
  <script src="<?php echo constant('URL');?>resources/js/toastr.min.js"></script>

</body>

</html>
