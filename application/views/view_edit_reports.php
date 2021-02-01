<script src="styles/js/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        height: 500,
        theme: 'modern',
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime nonbreaking save table contextmenu directionality',
            'template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true,
        templates: [
            { title: 'Test template 1', content: 'Test 1' },
            { title: 'Test template 2', content: 'Test 2' }
        ]       
    });
</script>

<style>
.mce-tinymce{
    z-index: 5000;
}
</style>
<div class="ibox">
    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-3">                    
                <h3>Список отчетов</h3>
                <ul class="sortable-list connectList agile-list ui-sortable">
                    <li class="warning-element">
                        Simply dummy text of the printing and typesetting industry.
                        <div class="agile-detail">                            
                            <i class="fa fa-clock-o"></i> 12.10.2015
                        </div>
                    </li>
                                    
                </ul>
            </div>        
            
            <div class="col-lg-9">                  
                <form method="post">        
                    <input type="text" class="form-control" name="TITLE_TEXT" placeholder="Название отчета"/>
                    <br />      
                    <textarea name="HTML_TEXT">Ввод текста здесь!</textarea>
                    <br />
                    <div class="col-lg-2">                    
                        <input type="date" name="DATE_ADD" class="form-control" value=""/>
                    </div>                
                    
                    <div class="col-lg-8"></div>    
                    <div class="col-lg-2">
                        <input type="hidden" name="ID" value="0"/>
                        <input type="submit" class="btn btn-success btn-block" value="Сохранить"/>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>