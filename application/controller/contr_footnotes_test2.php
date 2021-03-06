<?
     array_push($js_loader,        
        'styles/js/inspinia.js',
        'styles/js/plugins/pace/pace.min.js',
        'styles/js/plugins/slimscroll/jquery.slimscroll.min.js',
        'styles/js/plugins/chosen/chosen.jquery.js',
        'styles/js/plugins/jsKnob/jquery.knob.js',
        'styles/js/plugins/jasny/jasny-bootstrap.min.js',
        'styles/js/plugins/dataTables/jquery.dataTables.js',
        'styles/js/plugins/dataTables/dataTables.bootstrap.js',
        'styles/js/plugins/dataTables/dataTables.responsive.js',
        'styles/js/plugins/dataTables/dataTables.tableTools.min.js',
        'styles/js/plugins/datapicker/bootstrap-datepicker.js',
        'styles/js/plugins/nouslider/jquery.nouislider.min.js',
        'styles/js/plugins/switchery/switchery.js',
        'styles/js/plugins/ionRangeSlider/ion.rangeSlider.min.js',
        'styles/js/plugins/iCheck/icheck.min.js',
        'styles/js/plugins/metisMenu/jquery.metisMenu.js',
        'styles/js/plugins/colorpicker/bootstrap-colorpicker.min.js',
        'styles/js/plugins/clockpicker/clockpicker.js',
        'styles/js/plugins/cropper/cropper.min.js',
        'styles/js/plugins/fullcalendar/moment.min.js',
        'styles/js/plugins/daterangepicker/daterangepicker.js',
        'styles/js/plugins/summernote/summernote.min.js',
        'styles/js/plugins/Ilyas/addClients.js',
        'styles/js/tinymce/tinymce.min.js',
        
        'styles/js/plugins/preetyTextDiff/jquery.pretty-text-diff.min.js',
        
        'styles/js/plugins/diff_match_patch/javascript/diff_match_patch.js'
        );      
    
    array_push($css_loader, 
        'styles/css/plugins/dataTables/dataTables.bootstrap.css',
        'styles/css/plugins/dataTables/dataTables.responsive.css',
        'styles/css/plugins/dataTables/dataTables.tableTools.min.css',
        'styles/css/plugins/iCheck/custom.css',
        'styles/css/plugins/chosen/chosen.css',
        'styles/css/plugins/colorpicker/bootstrap-colorpicker.min.css',
        'styles/css/plugins/cropper/cropper.min.css',
        'styles/css/plugins/switchery/switchery.css',
        'styles/css/plugins/jasny/jasny-bootstrap.min.css',
        'styles/css/plugins/nouslider/jquery.nouislider.css',
        'styles/css/plugins/datapicker/datepicker3.css',
        'styles/css/plugins/ionRangeSlider/ion.rangeSlider.css',
        'styles/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css',
        'styles/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css',
        'styles/css/plugins/clockpicker/clockpicker.css',
        'styles/css/plugins/daterangepicker/daterangepicker-bs3.css',
        'styles/css/plugins/select2/select2.min.css',
        'styles/css/plugins/summernote/summernote-bs3.css',
        'styles/css/plugins/summernote/summernote.css',
        'styles/js/plugins/preetyTextDiff/jquery.pretty-text-diff.min.js',
        'styles/font-awesome/css/font-awesome.css',
        'styles/css/plugins/toastr/toastr.min.css'
    );
    
    $othersJs = "
    <script>
    $(document).ready(function () {
        
                // Initial diff1
                $('.diff-wrapper').prettyTextDiff({
                    diffContainer: '.diff1'
                });
        
        
                // Initial diff2
                $('.diff-wrapper2').prettyTextDiff({
                    originalContent: $('#original').val(),
                    changedContent: $('#changed').val(),
                    diffContainer: '.diff2'
                });
        
                // Run diff on textarea change
                $('.diff-textarea').on('change keyup', function() {
                    console.log('edit');
                    $('.diff-wrapper2').prettyTextDiff({
                        originalContent: $('#original').val(),
                        changedContent: $('#changed').val(),
                        diffContainer: '.diff2'
                    });
        
                });
        
            });
    </script>";
    
            
?>