$('.input-group.date').datepicker({
    format: 'dd-mm-yyyy',
    todayBtn: 'linked'        
});    
        
$('.dataTables-example').DataTable({
    'dom': 'lTfigt',
    'tableTools': {
        'sSwfPath': 'js/plugins/dataTables/swf/copy_csv_xls_pdf.swf'
    }
});


$(document).ready(function(){
    var config = {
        '.chosen-select'           : {},
        '.chosen-select-deselect'  : {allow_single_deselect:true},
        '.chosen-select-no-single' : {disable_search_threshold:10},
        '.chosen-select-no-results': {no_results_text:'Ничего не найдено'},
        '.chosen-select-width'     : {width:'95%'}
    }
            
    $('.chosen-select').chosen({width: '100%'});
            
    $('body').on('chosen', '.chosen-select')
            
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }
});

$('.edit_plan').click(function(){
    var id = $(this).attr('id');  
    $('textarea[name=name]').html('');      
    $('input[name=save]').val(id);
    $('input[name=num_pp]').val(max_num_pp);
    $('input[name=date_plan]').val('');
    $('#plan_out').prop('checked', false);
    
    $(".md_user > option").each(function() {                            
        $(this).prop('selected', false);                            
    });
    
    $(".md_dep > option").each(function() {                            
        $(this).prop('selected', false);                            
    });
    $('.md_dep').trigger("chosen:updated");
    $('.md_user').trigger("chosen:updated");
           
    if(id !== '0'){
        $.post(window.location.href, {"plan_dan":id}, function(data){
            var j = JSON.parse(data);
            console.log(j);
            $('textarea[name=name]').html(j.plan.NAME);
            $('input[name=num_pp]').val(j.plan.NUM_PP);
            $('input[name=date_plan]').val(j.plan.DATE_PLAN);
            
            if(j.plan.PLAN_OUT == '1'){$('#plan_out').prop('checked', true);}
            
            $.each(j.deps, function(i, e){
                var id_dep = e.ID_DEP;
                $(".md_dep > option").each(function() {                    
                    if(this.value == id_dep){
                        $(this).prop('selected', true);
                    }                    
                });                
            })
            
            $.each(j.users, function(i, e){
                var id_user = e.ID_USER;
                $(".md_user > option").each(function() {                    
                    if(this.value == id_user){
                        $(this).prop('selected', true);
                    }                    
                });                
            }) 
            
            $('.md_dep').trigger("chosen:updated");
            $('.md_user').trigger("chosen:updated");           
        });
    }
        
});

$('#set_state').click(function(){
    $('#save_edit').submit();
});

$('#set_last_state_btn').click(function(){
    $('#set_isp').submit();
})

$('body').on('click', '.step_top', function(){
    var id = $(this).attr('id');    
    $.post(window.location.href, {"step_top":id}, function(data){        
        $('#panel_table').html(data);
    });
})

$('body').on('click', '.step_bottom', function(){
    var id = $(this).attr('id');    
    $.post(window.location.href, {"step_bottom":id}, function(data){        
        $('#panel_table').html(data);
    });
});

$('body').on('click', '.set_last_state', function(){
    var id = $(this).attr('id');
    $('input[name=set_isp_last]').val(id);
});