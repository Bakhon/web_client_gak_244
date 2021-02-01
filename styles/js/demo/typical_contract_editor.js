///$('.summernote').summernote();
$('#editor_content').summernote({
    toolbar: [                            
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['table', ['table']],
        ['font', ['fontname']],
        ['view', ['fullscreen', 'codeview']]                    
    ],
    fontNames: ['Times New Roman'],
});
/*
$('.note-toolbar').each(function(){
    $(this).attr('style', 'display: none;')
})
*/


function defPosition(event) {
	var x = y = 0;
	var d = document;
	var w = window;

	if (d.attachEvent != null) { // Internet Explorer & Opera
		x = w.event.clientX + (d.documentElement.scrollLeft ? d.documentElement.scrollLeft : d.body.scrollLeft);
		y = w.event.clientY + (d.documentElement.scrollTop ? d.documentElement.scrollTop : d.body.scrollTop);
	} else if (!d.attachEvent && d.addEventListener) { // Gecko
		x = event.clientX + w.scrollX;
		y = event.clientY + w.scrollY;
	}
    console.log(x+' - '+y);
    x = x / 2 + 30;
    y = y + 10;
	return {x:x, y:y};
}


function menu(event) {
  // Блокируем всплывание события contextmenu
	event = event || window.event;
	event.cancelBubble = true;

	// Задаём позицию контекстному меню
	var menu = $('.right-menu').css({
		top: defPosition(event).y + "px",
		left: defPosition(event).x + "px"
	});

	// Показываем собственное контекстное меню
	menu.show();

	// Блокируем всплывание стандартного браузерного меню
	return false;
}

var selection, range;
$(document).on('click', '.note-editable', function() {       
    selection = window.getSelection();  
    range =  selection.getRangeAt(0)  	
});

$(document).on('keyup', '.note-editable', function(event) {       
    selection = window.getSelection();  
    range =  selection.getRangeAt(0)  	
});

$('.note-editable').on('contextmenu', function(e){
    selection = window.getSelection();
    range =  selection.getRangeAt(0)    
    return menu(e);
})

$(document).on('click', function(){
    $('.right-menu').hide();
});

$('.sets_text').click(function(){
    var b = $(this);
    var dt = b.attr('data-table');
    var dc = b.attr('data-col'); 
    var m = b.attr('data');
    insertHTML('<span class="meta" contenteditable="false" data-table="'+dt+'" data-col="'+dc+'">'+m+'</span>');         
});

function insertHTML(html) {
	try {
		var	temp = document.createElement('div'),
			insertion = document.createDocumentFragment();                
		temp.innerHTML = html;
        
		while (temp.firstChild) {
			insertion.appendChild(temp.firstChild);
		}
                        
		range.deleteContents();
		range.insertNode(insertion);                
	} catch (z) {
		try {
		  document.selection.createRange().pasteHTML(html);
		} catch (z) {}
	}
}

$('#editorsContent').click(function(){
    var cl = $(this).attr('class');                        
});   

$('.note-editable').children('.meta').click(function(){   
    console.log($(this).attr('data-table'));
   //$(this).addClass('active'); 
});

$('body').on('click', '.meta', function(){
    var s = $(this).hasClass('active');
    if(s == false){
        $(this).addClass('active');
    }else{
        $(this).removeClass('active');
    } 
});

$('body').on('keyup', function(e){
    var s = $('.meta.active').attr('class');
    var clas = $('#add_standart_contracts').attr('class');
    if(clas == 'modal inmodal fade in'){
        if(e.keyCode == 46){
            $('.meta.active').remove();
        }     
    }               
});



$('#new_block').click(function(){
    $('#table_test').html('');
     $('#table_test2').html('');
     $('#selectID').html('');     
     $('#selectID').hide();
    var s = window.location.href;
    var p = s.split('=');
    var id = p[1];
    id = id.trim();
    $.post(window.location.href, {"new_id_block":id}, function(data){
        $('input[name=POSITION]').val(data.trim());        
    });        
    $('.note-editable').html('');
    $('#TITLE_TEXT').val('');
    $('#id_block').val('0');    
})

$('#save').click(function(){
    var 
      id = $('#id_block').val(),
      id_rep = $('#add_standart_contracts').attr('data'),
      title = $('#TITLE_TEXT').val(),
      pos_num = $('input[name=POSITION]').val(),
      width_block = $('#blockCount').val(),
      html = $('.note-editable').html();
      
      var list_meta = [];
    $(".note-editable").find('.meta').each(function(){
        var 
            id_table = $(this).attr('data-table'),
            id_col = $(this).attr('data-col');
        
        var meta_array = {
            "id_table":id_table,
            "id_col":id_col            
        };    
        console.log(meta_array);    
        list_meta.push(meta_array);                
    });
      
             
    $.post(window.location.href, {
        "set_bloc_report":id_rep, 
        "id":id, 
        "name":title, 
        "size_p":width_block, 
        "position":pos_num, 
        "html":html,
        "list_meta":list_meta },          
    function(data){
        $('.content-report').html(data);      
    });                    
  })
     
function add_settings(id) {
     
  
 $('#save_form_params').click(function()
 {
    var
       
       id_check = $('#id_block').val(),
       ids = $('#add_params').attr('data'),
 /*      id_table = $('#PARAMS_TABLE').val(),
       id_condit = $('#PARAMS_CONDIT').val(),
       id_col = $('#PARAMS_COLUMNS').val(),
       res = $('#PARAMS_RES').val(),            */   
       id_type_contract = $('#form input:checked').map(function(){
            return $(this).val();
        }).get();                                                                 
       
       $.post(window.location.href, 
       {  
          "add_settings": id,
          "id_check": id_check,
          "set_param_report":ids,                   
/*          "params_table":id_table,
          "params_condit":id_condit,
          "params_column":id_col,
          "params_res":res,  */
          "vid_dog":id_type_contract
        },
          function(data)
          {
            $().html(data);
           console.log(data);           
          });    
 });    
 }
 
function edit_block(id)
{   
    $('#table_test').html('');
    $('#table_test2').html('');
    $('#selectID').html('');
    $.post(window.location.href, {"edit_block":id}, function(data){
       var j = JSON.parse(data);     
       $('#id_block').val(j.ID);
       $('#TITLE_TEXT').val(j.NAME);
       $('input[name=POSITION]').val(j.POSITION);
       $('#blockCount').val(j.SIZE_P);
       $('.note-editable').html(j.HTML_TEXT);  
       for($i=0;$i<j.list_params.length;$i++){
         $rt = j.list_params[$i];
         $('#table_test').append('<tr><td id="td1">'+$rt.TABLE_NAME+'('+$rt.TABLE_META+')</td><td id="td2">'+$rt.COL_NAME+'('+$rt.COL_META+')</td><td id="td3">'+$rt.CONDT+'</td><td id="td4">'+$rt.RES+'</td><td id="td5"> <button id="'+$rt.ID+'" class="btn btn-danger btn-xs trash_param"><i class="fa fa-trash">Удалить</i></button> </td></tr> <hr/>');         
       }
       
       for($s=0;$s<j.list_set.length;$s++){        
        $rt2 = j.list_set[$s];
        $('#table_test2').append('<tr><td>'+$rt2.NAME+'</td><td > <button id="'+$rt2.ID+'" class="btn btn-danger btn-xs trash_param2"><i class="fa fa-trash">Удалить</i></button> </td></tr> ' );      
                
       }
       
       $('#selectID').append('<option value="0">Выберите тип договора</option>');
       for ($q = 0; $q < j.list_select_params.length; $q++)
{      $rt3 = j.list_select_params[$q];


$('#selectID').append( '<option value="'+$rt3.ID+'">'+$rt3.NAME+'</option>' );
}
       
       
           $('#selectID').change(function(){
        var idr = $(this).val();
        console.log(id);
        $.post(window.location.href, {"select_html_text":idr, "edit_blockr":id}, function(data){
              var s = JSON.parse(data); 
              console.log(s)
      //    $('.note-editable').html(data);
           $('.note-editable').html(s.HTML_TEXT);
                       
             console.log(data);
            $('.note-editable').change(); 
        });         
    });
       
                         
       $('.trash_param').click(function(){
        var id = $(this).attr('id');  
        var ids = $('#add_standart_contracts').attr('data');               
        console.log(id);
        $.post(window.location.href, {"del_param":id, "id_rep": ids}, function(data){   
             $('').html(data);
             
              console.log(data);                          
                       
        });               
    });   
    
         $('.trash_param2').click(function(){
        var idr = $(this).attr('id');  
        var ids = $('#add_standart_contracts').attr('data');               
        console.log(id);
        $.post(window.location.href, {"del_param_kind_contr":idr, "id_rep": id}, function(data){   
             $('').html(data);
              console.log(data);                          
                       
        });               
    });      
    
    
                                 
    });   
    
    
  $('#save_form_params2').click(function()
 {
    var
    //   id_check = $('#id_block2').val(),
       ids = $('#add_params2').attr('data'),
       id_table = $('#PARAMS_TABLE2').val(),
       id_condit = $('#PARAMS_CONDIT2').val(),
       id_col = $('#PARAMS_COLUMNS2').val(),
       res = $('#PARAMS_RES2').val();               
                                                                
       
       $.post(window.location.href, 
       {  
          "edit_block2": id,         
          "set_param_report2":ids,                   
          "params_table2":id_table,
          "params_condit2":id_condit,
          "params_column2":id_col,
          "params_res2":res
        },
          function(data)
          {       
           //  var q = JSON.parse(data); 
         //   $('#table_test').html(q.NAME);   
           console.log(data);           
          });    
 });

                            
}


function deleteBlock(id)
{
    var ids = $('#add_standart_contracts').attr('data');    
    $.post(window.location.href, {"del_block":id, "id_report":ids}, function(data){
        console.log(data);
        $('.content-report').html(data);
    });
}

window.onscroll = function() {
  var scrolled = window.pageYOffset || document.documentElement.scrollTop;
  if(scrolled > 200){
	$('.head_panel').attr('style', 'position: fixed;top: 0px;z-index: 5000;width: 87%;');
  }else{
	$('.head_panel').attr('style', '');
  }  
}







