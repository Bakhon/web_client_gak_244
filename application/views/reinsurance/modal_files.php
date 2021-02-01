<div class="modal inmodal fade" id="modal_files" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Документы договора перестрахования</h4>                
            </div>
            <div class="modal-body" style="background: #fff;">
                <div class="row">                    
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>№</th>
                            <th>Наименование</th>
                            <th>Файл</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="table_files">
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>                            
                    </tbody>
                    </table>                                                                                                                                                                                                                 
                </div>                                
            </div>
            
            <div class="modal-footer">      
                <div class="row">
                    <form method="post" enctype="multipart/form-data" id="form_files">
                        <div class="col-lg-6">
                            <select name="set_new_contract_file" class="set_new_contract_file form-control pull-left"></select>    
                        </div>
                        <div class="col-lg-4">
                            <input type="file" id="btn_load_file" name="upload" style="display: none;"/>
                            <span class="load_file btn btn-success btn-block">Выбрать файл и сохранить</span>
                        </div>
                        <input type="hidden" name="contract_file_id" value=""/>
                    </form>
                    
                    <div class="col-lg-2">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
                    </div>
                </div>                                              
            </div>
        </div>
    </div>
</div>

<script>
$('.contracts_files').click(function(){
    var id = $(this).attr('data');
    $('input[name=contract_file_id]').val(id);
    $('.set_new_contract_file').html('');
    $('#table_files').html('');
    var html = '';
    var num = 0;
    $.post(window.location.href, {"contract_files":id}, function(data){          
        $.each(data, function(i, e){     
            $('.set_new_contract_file').append('<option value="'+e.ID+'">'+e.NAME+'</option>');
            if(e.list_files.length > 0){                
                $.each(e.list_files, function(n, d){
                    num++;
                    html += '<tr><td>'+num+'</td>'+
                    '<td>'+e.NAME+'</td>'+
                    '<td><a href="reins_ns?downloadfile='+d.ID+'" target="_blank" class="btn btn-success">Скачать (Загружен '+d.DATE_SET+' г.)</a></td>'+
                    '<td><span class="btn btn-danger del_file" id="'+d.ID+'"><i class="fa fa-trash"></i></span></td></tr>';
                });
            }
        }); 
        $('#table_files').html(html);       
    });
});

$('.load_file').click(function(){
    $('#btn_load_file').click();
});

$('#btn_load_file').on('change', function(){
    $('#form_files').submit();
});

$('body').on('click', '.del_file', function(){
    var id = $(this).attr('id');
    $.post(window.location.href, {"delete_file":id}, function(data){
        //console.log(data);
        $('#table_files').html('');
        var html = '';
        $.each(data, function(i, e){
            if(e.list_files.length > 0){                
                $.each(e.list_files, function(n, d){
                    num++;
                    html += '<tr><td>'+num+'</td>'+
                    '<td>'+e.NAME+'</td>'+
                    '<td><a download href="ftp://upload:Astana2014@192.168.5.2'+d.FILENAME+'" target="_blank" class="btn btn-success">Скачать (Загружен '+d.DATE_SET+' г.)</a></td>'+
                    '<td><span class="btn btn-danger del_file" id="'+d.ID+'"><i class="fa fa-trash"></i></span></td></tr>';
                });
            }
        }); 
        $('#table_files').html(html);                   
    }) 
});
</script>