<script>
    const base_url = "<?= base_url(); ?>";
    const smony = "<?= SMONEY . " "; ?>";
</script>

<!-- Essential javascripts for application to work-->
<script src="<?= media() ?>/js/jquery-3.3.1.min.js"></script>
<script src="<?= media() ?>/js/popper.min.js"></script>
<script src="<?= media() ?>/js/bootstrap.min.js"></script>
<script src="<?= media() ?>/js/main.js"></script>
<script src="<?= media() ?>/js/functionsAdmin.js"></script>
<!-- Font Awesome -->
<script src="<?= media(); ?>/js/fontawesome.js"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="<?= media() ?>/js/plugins/pace.min.js"></script>
<!-- Sweet alert 2 - https://sweetalert2.github.io/ -->
<script type="text/javascript" src="<?= media(); ?>/js/plugins/sweetalert2.all.min.js"></script>
<!-- Tinymce - https://www.tiny.cloud/ -->
<script type="text/javascript" src="<?= media(); ?>/js/tinymce/tinymce.min.js"></script>
<!-- Bootstrap-select -->
<script type="text/javascript" src="<?= media(); ?>/js/plugins/bootstrap-select.min.js"></script>
<!-- Data table plugin -->
<script type="text/javascript" src="<?= media(); ?>/js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?= media(); ?>/js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<!-- https://www.highcharts.com/demo -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<!-- https://jqueryui.com/ -->
<script type="text/javascript" src="<?= media(); ?>/js/datepicker/jquery-ui.min.js"></script>

<script src="<?= media(); ?>/js/<?= $data['page_functions_js'] ?>"></script>
</body>

</html>