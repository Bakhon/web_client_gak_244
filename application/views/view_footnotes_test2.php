<textarea onkeypress="text_editing();" class="col-lg-12" id="textareaid" style="height: 200px;">
    Lorem Ipsum is simply
    dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with 
    Remaining essentially unchanged
    Make a type specimen book
    Unknown printer
</textarea>
<a>Modal</a>
<a onclick="insertAtCaret('textareaid', 'text to insert');return false;">Insert</a>
                                    
<div class="modal inmodal fade" id="add_new_text" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Ответ на комментарий</h4>
                <small class="font-bold"></small>
            </div>
            <div class="modal-body">
            <div class="form-group">
            <div class="row">
            <label>Автор</label> <input disabled="" value="<?php echo $active_user_dan['emp_name']; ?>" class="form-control" type="email"/>
            </div>
            </div>
            <div class="row">
            <div class="social-comment">
                <div class="media-body">
                    <textarea id="placeForReplText" autofocus class="form-control"></textarea>
                </div>
            </div>
            </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" onclick="get_text_and_set();" data-dismiss="modal">Добавить текст</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<button data-toggle="modal" data-target="#add_new_text" id="popUpBox" class="btn btn-primary btn-xs m-l-sm" type="button">Добавить комментарий<? echo ' '.$active_user_dan['emp_name'];?></button>
                        
<script>
        jQuery(function($) {
         
            var $txt = '';
             
            $('#textareaid').bind("mouseup", function(e){
                
                console.log(e.pageX+' '+e.pageY);
                var xPos = e.pageX - 230;
                var yPos = e.pageY - 20;
                if (window.getSelection){
                    $txt = window.getSelection();
                }
                else if (document.getSelection){
                    $txt = document.getSelection();
                }
                else if (document.selection){
                    $txt = document.selection.createRange().text;
                }
                else return;
                if    ($txt!=''){
                    $('#popUpBox').css({'display':'block', 'left':e.pageX+0+'px', 'top':e.pageY+0+'px'});
                }
            });
    });
    
    jQuery(function($) {
         
            var $txt = '';
             
            $('#textareaid').click("mouseup", function(e){
                
                console.log(e.pageX+' '+e.pageY);
                var xPos = e.pageX - 230;
                var yPos = e.pageY - 20;
                $('#popUpBox').css({'display':'block', 'left':e.pageX+0+'px', 'top':e.pageY+0+'px'});
            });
    });        
                

    function text_editing(){
        event.preventDefault();
        $('#add_new_text').modal('toggle');
    }

    function get_text_and_set(){
        var text = $('#placeForReplText').val();
        var text_with_tags = '<p color="red">'+text+'</p>';
        insertAtCaret('textareaid', text_with_tags);
        var text = $('#placeForReplText').val('');
        return false;
    }

    //вставляет в текстАреа элемент по координатам курсора
	function insertAtCaret(areaId, text) {
		var txtarea = document.getElementById(areaId);
		if (!txtarea) { return; }

		var scrollPos = txtarea.scrollTop;
		var strPos = 0;
		var br = ((txtarea.selectionStart || txtarea.selectionStart == '0') ?
			"ff" : (document.selection ? "ie" : false ) );
		if (br == "ie") {
			txtarea.focus();
			var range = document.selection.createRange();
			range.moveStart ('character', -txtarea.value.length);
			strPos = range.text.length;
		} else if (br == "ff") {
			strPos = txtarea.selectionStart;
		}

		var front = (txtarea.value).substring(0, strPos);
		var back = (txtarea.value).substring(strPos, txtarea.value.length);
		txtarea.value = front + text + back;
		strPos = strPos + text.length;
		if (br == "ie") {
			txtarea.focus();
			var ieRange = document.selection.createRange();
			ieRange.moveStart ('character', -txtarea.value.length);
			ieRange.moveStart ('character', strPos);
			ieRange.moveEnd ('character', 0);
			ieRange.select();
		} else if (br == "ff") {
			txtarea.selectionStart = strPos;
			txtarea.selectionEnd = strPos;
			txtarea.focus();
		}

		txtarea.scrollTop = scrollPos;
	}
</script>

<style type="text/css">
body{
margin:0; padding:0;
}
 
#popUpBox {
    position:absolute; 
    display:none;  
    background:#1ab394;
    cursor: pointer;
    color: #fff;
    font: bold 14px open sans;
    padding:0px 0px;
}
 
#popUpBox:hover{
    background:#686b6d;
    color: #fff;
}

#popUpBox:active{
    display: none;
}
 
.content {
    position:relative; 
    margin:10px auto; 
    height:auto; 
    width:900px;
    border:1px solid #ccc; 
    padding:10px;
}
 
.twrap{
    position:relative;
    width:920px;
    margin:10px auto;
    height:auto;
}
 
#replytext{
    position:relative;
    width:600px;
    margin:0;
    height:150px;
}

.note-editor .note-editable{
    padding: 100px 100px 100px 200px;
}

/* floating footnote div
            This will be loaded on EVERY page, and its difficult to get around this
            in wordpress. So its better if you paste this into your template's css
            and then disable the "enque css" line in the php file...
            ---just remember that you must do it again if you change templates!---
             */

            /* Style The hover popup  */
            #footnotediv {
                position:absolute;
                background-color:white;
                padding:3px;
                padding-left:12px;
                padding-right:12px;
                border:1px solid #CDBBB5;
                box-shadow:#555 0 0 10px;
                -webkit-box-shadow:#555 0 0 10px;
                -moz-box-shadow:0 0 10px #555;
                z-index:99;
            }




            /* Style Reference Marks  */
            .fn-ref-mark {
                /*  font-size: 80%;
                   vertical-align: super;  has tendancy of skewing line spacing.  fix? */
                }

            /* Style Footnote Heading Title  */
            #fn-heading {
                font-weight: bold;
                }

            /* Style Footnote Text  */
            .fn-text {
                text-decoration:none;
                }

            /* If you want to style just the back link
             after the footnote text   */
            a.fn-text {
                border-bottom:none;
            }

            /* If you use an image as a footnote
             text backlink   */
            a.fn-text img {
                margin:0;
                padding:0;
                border:0;
            }
</style>
