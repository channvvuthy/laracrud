<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>

<!-- Select2 -->
{{-- <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script> --}}
<!-- Bootstrap4 Duallistbox -->
{{-- <script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script> --}}
<!-- InputMask -->
{{-- <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script> --}}
<!-- Bootstrap Switch -->
{{-- <script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script> --}}
<!-- BS-Stepper -->
{{-- <script src="{{ asset('plugins/bs-stepper/js/bs-stepper.min.js') }}"></script> --}}
<!-- dropzonejs -->
{{-- <script src="{{ asset('plugins/dropzone/min/dropzone.min.js') }}"></script> --}}
<!-- AdminLTE App -->
{{-- <script src="{{ asset('dist/js/adminlte.min.js') }}"></script> --}}

{{-- <script>
    $(function() {
        //Date and time picker
        $('.created_at, .updated_at').datetimepicker({
            format: 'L'
        });
        
    })
</script> --}}
</body>

</html>
