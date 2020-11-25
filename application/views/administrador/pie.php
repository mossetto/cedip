  
    </section>
    <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Version 1.0.0 
    </div>
    <!-- Default to the left -->
    <strong>desarrollo <a href="http://www.pilsendigital.com">pilsendigital.com</a></strong>.
  </footer>
    <aside class="control-sidebar control-sidebar-dark">
        <?php echo $config ?>
    </aside>
      <!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
</div>
<!-- Core Scripts - Include with every page -->
    <script src="<?php echo base_url(); ?>recursos/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>recursos/plugins/bootstrap/bootstrap.min.js"></script>
    <?php foreach($js_files as $file): ?>
            <script src="<?php echo $file; ?>"></script>
	<?php endforeach; ?>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>recursos/dist/js/app.min.js"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url(); ?>recursos/dashboard/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>recursos/dashboard/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>recursos/js/bootstrap-table.js"></script>
</body>

</html>