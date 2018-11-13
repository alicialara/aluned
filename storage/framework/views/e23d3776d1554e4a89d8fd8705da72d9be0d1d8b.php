<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>LSI UNED - <?php echo $__env->yieldContent('title'); ?> </title>


    <link rel="stylesheet" href="<?php echo asset('css/vendor.css'); ?>" />
    <link rel="stylesheet" href="<?php echo asset('css/app.css'); ?>" />

    <!-- Scripts -->
    <script>
        window.Laravel = '<?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>'
    </script>
</head>
<body style="font-size: 15px;">
<?php echo $__env->make('modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <!-- Wrapper-->
<div id="wrapper">

    <!-- Navigation -->
    <?php echo $__env->make('layouts.navigation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <!-- Page wraper -->
    <div id="page-wrapper" class="gray-bg">

        <!-- Page wrapper -->
        <?php echo $__env->make('layouts.topnavbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <!-- Main view  -->
        <?php if(Session::has('message')): ?>
            <p class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>"><?php echo e(Session::get('message')); ?></p>
            <?php endif; ?>
            <?php echo $__env->yieldContent('content'); ?>

                    <!-- Footer -->
            

    </div>
    <!-- End page wrapper-->

</div>
<!-- End wrapper-->

<script src="<?php echo asset('js/app.js'); ?>" type="text/javascript"></script>
<script src="<?php echo asset('js/tinymce/tinymce.min.js'); ?>" type="text/javascript"></script>

<!-- Mainly scripts -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/colreorder/1.3.2/css/colReorder.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.0/css/rowReorder.dataTables.min.css" />
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/colreorder/1.3.2/js/dataTables.colReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.2.0/js/dataTables.rowReorder.min.js"></script>

<?php echo $__env->yieldPushContent('scripts_datatables'); ?>

<?php $__env->startSection('scripts'); ?>
<?php echo $__env->yieldSection(); ?>

<script>
    $(document).ready(function() {
        if($('table[class*="tabla_voting"]').length) {
            $("input[type=checkbox]").click().click();

            var $check = $("input[type=checkbox]"), el;
            $check
                    .each(function(e){
                        var value = $(this).val();
                        var id = $(this).attr('id');

                        el = $(this);
                        switch(value) {
                            // unchecked, going indeterminate
                            case "3":
                                el.data('checked',1);
                                el.prop('indeterminate',true);
                                el.val('3');
                                var sel1 = 'i[class*=" unchecked '+id+'"]';
                                var sel2 = 'i[class*=" checked '+id+'"]';
                                var sel3 = 'i[class*=" undeterminate '+id+'"]';

                                $(sel1).hide();
                                $(sel2).hide();
                                $(sel3).show();


                                break;

                            // indeterminate, going checked
                            case "1":
                                el.data('checked',2);
                                el.prop('indeterminate',false);
                                el.prop('checked',true);
                                el.val('1');

                                var sel1 = 'i[class*=" unchecked '+id+'"]';
                                var sel2 = 'i[class*=" checked '+id+'"]';
                                var sel3 = 'i[class*=" undeterminate '+id+'"]';
                                $(sel1).hide();
                                $(sel2).show();
                                $(sel3).hide();


                                break;

                            // checked, going unchecked
                            case "0":
                                el.data('checked',0);
                                el.prop('indeterminate',false);
                                el.prop('checked',false);
                                el.val('0');

                                var sel1 = 'i[class*=" unchecked '+id+'"]';
                                var sel2 = 'i[class*=" checked '+id+'"]';
                                var sel3 = 'i[class*=" undeterminate '+id+'"]';
                                $(sel1).show();
                                $(sel2).hide();
                                $(sel3).hide();


                        }
                    })
                    .click(function(e) {

                        el = $(this);
                        var id = $(this).attr('id');
                        switch(el.data('checked')) {

                            // unchecked, going indeterminate
                            case 0:
                                el.data('checked',1);
                                el.prop('indeterminate',true);
                                el.val('3');

                                var sel1 = 'i[class*=" unchecked '+id+'"]';
                                var sel2 = 'i[class*=" checked '+id+'"]';
                                var sel3 = 'i[class*=" undeterminate '+id+'"]';

                                $(sel1).hide();
                                $(sel2).hide();
                                $(sel3).show();

                                break;

                            // indeterminate, going checked
                            case 1:
                                el.data('checked',2);
                                el.prop('indeterminate',false);
                                el.prop('checked',true);
                                el.val('1');

                                var sel1 = 'i[class*=" unchecked '+id+'"]';
                                var sel2 = 'i[class*=" checked '+id+'"]';
                                var sel3 = 'i[class*=" undeterminate '+id+'"]';
                                $(sel1).hide();
                                $(sel2).show();
                                $(sel3).hide();


                                break;

                            // checked, going unchecked
                            default:
                                el.data('checked',0);
                                el.prop('indeterminate',false);
                                el.prop('checked',false);
                                el.val('0');

                                var sel1 = 'i[class*=" unchecked '+id+'"]';
                                var sel2 = 'i[class*=" checked '+id+'"]';
                                var sel3 = 'i[class*=" undeterminate '+id+'"]';
                                $(sel1).show();
                                $(sel2).hide();
                                $(sel3).hide();

                        }

                    })
            ;

            $('input[type="checkbox"]').hide();
        }
        var editor_config = {
            path_absolute : "/",
            selector: "textarea",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | forecolor backcolor",
            relative_urls: false,
            file_browser_callback_types: 'file image media',
            file_browser_callback : function(field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.open({
                    file : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no"
                });
            }
        };

        tinymce.init(editor_config);
        if($('textarea').length){
            $('a[class="navbar-minimalize minimalize-styl-2 btn btn-primary "]').click();
        }


    } );
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.2/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.2/locale/es.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.7.0/fullcalendar.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.7.0/fullcalendar.min.js"></script>

</body>
</html>