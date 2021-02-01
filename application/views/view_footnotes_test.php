<div class="row">
    <input hidden="" id="name" value="<? echo $active_user_dan['emp_name'];?>"/>
    <input hidden="" id="date" value="<? echo $active_user_dan['emp_name'];?>"/>
    <input id="name1"/>
    <div class="col-lg-10">
    <!-- onclick="add_text();"  -->
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Редактор документов ГАК 1.0 (бета)</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-wrench"></i>
                </a>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <!--<div class="ibox-content no-padding editorsContent" id="editorsContent" onkeypress="this.nextSibling.innerHTML = getChar(event)+''" style="height: 160em;">-->
        <div class="ibox-content no-padding editorsContent" id="editorsContent" onkeypress="this.nextSibling.innerHTML = getChar(event)+''" style="height: 160em;">
            <div class="summernote contentareaComment">
                <h3>Lorem Ipsum is simply</h3>
                dummy text of the printing and typesetting industry. <strong>Lorem Ipsum has been the industry's</strong> standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic
                typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with
                <br/>
                <br/>
                <ul>
                    <li>Remaining essentially unchanged</li>
                    <li>Make a type specimen book</li>
                    <li>Unknown printer</li>
                </ul>
            </div>
            <textarea id="textareaid"></textarea>
            <a href="#" onclick="insertAtCaret('textareaid', 'text to insert');return false;">Click Here to Insert</a>
                </div>
            </div>
    
</div>
<div class="col-lg-2">
    <div id="comments_list"></div>
</div>
</div>
                                    <button onclick="addComment();" id="popUpBox" class="btn btn-primary btn-xs m-l-sm" type="button">Добавить комментарий<? echo 
                                    ' '.$active_user_dan['emp_name'];?></button>
                                    
                                    <script>
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
                                    
                                        function getChar(event) {
                                          $('#add_new_text').modal('toggle');//всплывает модальное окно
                                          //$('#placeForReplText').focus();
                                          var c = $('#placeForReplText');
                                          c.trigger('focus');
                                          event.preventDefault();
                                          if (event.which == null) { // IE
                                            if (event.keyCode < 32) console.log( null); // спец. символ
                                                console.log (String.fromCharCode(event.keyCode))
                                            }
                                          
                                          if (event.which != 0 && event.charCode != 0) { // все кроме IE
                                            if (event.which < 32) alert ( null); // спец. символ
                                            console.log ( String.fromCharCode(event.which)); // остальные
                                            
                                            var simb = String.fromCharCode(event.which);
                                            
                                            $('.placeForReplText').append(String.fromCharCode(event.which));
                                            var txt_reverse = $('#placeForReplText').val();
                                          }
                                          return null; // спец. символ
                                        }
                                    </script>
                                    <script>
                                        function add_text(){
                                            var newText = $('#placeForReplText').val();
                                            $('#document_fragment').remove();
                                            insertHTML('<span class="main" id="document_fragment" style="background-color: rgb(255, 255, 0);">'+newText+'</span>');

                                            //addComment();
                                            //saveComment();
                                        }
                                        
                                    </script>
                                    <script>
                                        $('#editorsContent').on('keyup', function(e){
                                           insertCurrentPlace = ''; // ловим текущий тег
                                           caret = ''; // положение каретки
                                           caret = window.getSelection().anchorOffset;
                                           console.log(caret);
                                        });
                                    </script>
                                    <script>
                                        $("#editorsContent").click(function(e) {
                                          var offset = $(this).offset();
                                          var relativeX = (e.pageX - offset.left);
                                          var relativeY = (e.pageY - offset.top);
                                         
                                          console.log("X: " + relativeX + "  Y: " + relativeY);
                                          
                                        });
                                    </script>
                                    
                                    <script type="text/javascript">
                                    jQuery(function($) {
                                     
                                        var $txt = '';
                                         
                                        $('#editorsContent').bind("mouseup", function(e){
                                            
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
                                         
                                        $(document).bind("mousedown", function(){
                                            $('#popUpBox').css({'display':'none'});
                                        });
                                         
                                        $('#popUpBox').bind("mousedown", function(){
                                            $('#replytext').val($txt);
                                            addComment();
                                            saveComment();
                                        });     
                                    });
                                    </script>
                                    <script>
                                        function addComment(){
                                                var txt = '';
                                                if (window.getSelection) {
                                                    txt = window.getSelection();
                                                    $('#partOfText').val(txt);
                                                    var theParent = txt.getRangeAt(0).deleteContents ();
                                                } else if (document.getSelection) {
                                                    txt = document.getSelection();
                                                    alert(txt);
                                                    var theParent = txt.getRangeAt(0).deleteContents ();
                                                } else if (document.selection) {
                                                    txt = document.selection.createRange().text;
                                                    $('#partOfText').val(txt);
                                                    var theParent = txt.getRangeAt(0).deleteContents ();
                                                }
                                                var theParent = txt.getRangeAt(0).deleteContents ();
                                                replaceTextForColor();
                                            }
                                            
                                        function saveComment(){
                                            var editedText = $('#partOfText').val();
                                            var partForComment = $('#partForComment').val();
                                            addCommentBlock(' редактировал: ', editedText, partForComment);
                                        }
                                    </script>
                                    <script>
                                        function getRandomColor() {
                                            var letters = '0123456789ABCDEF';
                                            var color = '#';
                                            for (var i = 0; i < 6; i++ ) {
                                                color += letters[Math.floor(Math.random() * 16)];
                                            }
                                            return color;
                                        }
                                    </script>
                                    <script>
                                    var color = getRandomColor();
                                    $('#editorsContent').click(function(){
                                      console.log('start');
                                      
                                      var c = $('#editorsContent');
                                      c.trigger('focus');
                                      //setDiv('777');
                                        
                                      var name = $('#name').val();
                                      var edit = true;
                                      var x, y; 
                                      $('#editorsContent').on('keypress', function(e){
                                        if(edit){
                                          $(this).trigger('focus');
                                          //var simv = $(this).trigger();
                                          //console.log(simv);
                                          //$(this).trigger(console.log(this));
                                          //insertHTML('<sup style="background-color: '+color+'; color: #FFFFFF;" >'+name+'</sup>');
                                          edit = false;
                                        }
                                      });
                                    
                                    });
                                    
                                    function addCommentBlock(functionWithText, editedText, comment){
                                        Data = new Date();
                                        //document.write(Data);
                                        var name = $('#name').val();
                                        $('#comments_list').append('<div class="social-footer" id="777">'+
                                                                        '<div class="social-comment">'+
                                                                        '<a href="#" class="pull-left">'+
                                                                            //'<img alt="image" src="img/a2.jpg">'+
                                                                        '</a>'+
                                                                        '<div class="media-body">'+
                                                                           ' <a href="#">'+
                                                                                name+
                                                                            '</a>'+
                                                                            functionWithText+
                                                                            '<span style="color: red;">'+editedText+'</span>'+
                                                                            '<br/>'+
                                                                            '<div class="hr-line-dashed"></div>'+
                                                                            '<div class="media-body">'+
                                                                            '<textarea autofocus class="form-control" style="resize: none; height: 100px;" id="partForNewCommentAns" placeholder="Write comment..."></textarea>'+
                                                                            '</div>'+
                                                                            '<br/>'+
                                                                            '<small class="text-muted">'+Data+'</small>'+
                                                                            '<button class="btn btn-white btn-xs"><i class="fa fa-share"></i>Добавить комментарий</button>'+
                                                                        '</div>'+
                                                                    '</div>'+
                                                                '</div>')
                                    }
                                    </script>
                                    <script>
                                        $('#deleteFragment').click(
                                            function(){
                                                var txt = '';
                                                if (window.getSelection) {
                                                    txt = window.getSelection();
                                                    $('#partOfText').val(txt);
                                                    var theParent = txt.getRangeAt(0).deleteContents ();
                                                } else if (document.getSelection) {
                                                    txt = document.getSelection();
                                                    alert(txt);
                                                    var theParent = txt.getRangeAt(0).deleteContents ();
                                                } else if (document.selection) {
                                                    txt = document.selection.createRange().text;
                                                    $('#partOfText').val(txt);
                                                    var theParent = txt.getRangeAt(0).deleteContents ();
                                                }
                                                var theParent = txt.getRangeAt(0).deleteContents ();
                                                replaceTextForStrikethrough();
                                            }
                                        )
                                        
                                        function replaceTextForStrikethrough(){
                                            var textForStrike = $('#partOfText').val();
                                            var color = getRandomColor();
                                            var name = $('#name').val();
                                            window.selectedMeta = '<strike style="color:'+ color+';">'+textForStrike+'</strike>';
                                            $('#partOfText').val(textForStrike);
                                            console.log(textForStrike);
                                            var c = $('.editorsContent');
                                            c.trigger('focus');
                                            insertHTML(selectedMeta);
                                        }
                                        
                                        function replaceTextForColor(){
                                            var id = 777;
                                            var textForStrike = $('#partOfText').val();
                                            var color = getRandomColor();
                                            var name = $('#name').val();
                                            window.selectedMeta = '<span onmouseover="showComment('+id+');" onmouseout="showCommentFalse('+id+');" style="background-color: rgb(255, 255, 0);">'+textForStrike+'</span>';
                                            $('#partOfText').val(textForStrike);
                                            console.log(textForStrike);
                                            var c = $('.editorsContent');
                                            c.trigger('focus');
                                            insertHTML(selectedMeta);
                                        }
                                        
                                        function showCommentFalse(id){
                                            $('#'+id+'').css({ boxShadow: '0px 0px 0px #444'});
                                            console.log('out');
                                        }
                                        
                                        function showComment(id){
                                            $('#'+id+'').css({ boxShadow: '0px 0px 10px #1ab394'});
                                            console.log(id);
                                        }
                                        
                                        function insertHTML(html) {
                                                try {
                                                    var selection = window.getSelection(),
                                                        range = selection.getRangeAt(0),
                                                        temp = document.createElement('div'),
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
                                            
                                        
                                    </script>
                                    <script>
                                        $(document).ready(function() {
                                             $("body").keydown(function(e) {
                                                      if (e.which == 8 || e.which == 46) {
                                                            e.preventDefault();
                                                            var txt = window.getSelection();
                                                            console.log(txt+'txt');
                                                            if (window.getSelection) {
                                                                $('#partOfText').val(txt);
                                                                var theParent = txt.getRangeAt(0).deleteContents ();
                                                            } else if (document.getSelection) {
                                                                $('#partOfText').val(txt);
                                                                alert(txt);
                                                                var theParent = txt.getRangeAt(0).deleteContents ();
                                                            } else if (document.selection) {
                                                                $('#partOfText').val(txt);
                                                                var theParent = txt.getRangeAt(0).deleteContents ();
                                                            }
                                                            var theParent = txt.getRangeAt(0).deleteContents ();
                                                            replaceTextForStrikethrough();
                                                            $('#deleteFragment').click();
                                                            $('#partOfText').val(txt);
                                                      }
                                             });
                                        });
                                    </script>
                  <script>
                     $('#save').click(function(){
                        var editorsContent = $("#editorsContent").html();
                        $("#textAreaForDB").html(editorsContent);
                        console.log(editorsContent);
                    })
                     </script>
                     <script>
                        $(document).ready(function(){
                            $('.summernote').summernote();
                        });
                        var edit = function() {
                            $('.click2edit').summernote({focus: true});
                        };
                        var save = function() {
                            var aHTML = $('.click2edit').code(); //save HTML If you need(aHTML: array).
                            $('.click2edit').destroy();
                        };
                    </script>
                    <script>
                            $(document).ready(function(){
                                var t = document.getElementById('inputTextArea');
                                
                                var pos = $('input[name=position]:checked').val();
                                var lang =  $('input[name=lang]:checked').val();
                                $('#numberOfRows').change(function(){
                                    window.colcount = $('#blocksCount option:selected').val();
                                    console.log(colcount);
                                    window.numberOfRows = $('#numberOfRows option:selected').val();
                                    console.log(numberOfRows);
                                    window.lang = $('input[name=lang]:checked').val();
                                    console.log(lang);
                                })
                            })
                    </script>                })};
</script>
        <script>
            $('#delete').click(function(){
                        var delText = $('#input').val();
                        
                        //var c = $('#field');
                        //var c = $('#editorsEditContent');
                        //var c = $('.note-codable');
                        //var c = $('.note-editable');
                        
                        c.trigger('focus');
                   })
            
                    
        </script>
            <script>
                // this script requires jQuery
                jQuery(document).ready(function() {
                    Footnotes.setup();
                });
        
                var Footnotes = {
                    footnotetimeout: false,
                    setup: function() {
                        var footnotelinks = jQuery("a[class='fn-ref-mark']")
        
                        footnotelinks.unbind('mouseover',Footnotes.footnoteover);
                        footnotelinks.unbind('mouseout',Footnotes.footnoteoout);
        
                        footnotelinks.bind('mouseover',Footnotes.footnoteover);
                        footnotelinks.bind('mouseout',Footnotes.footnoteoout);
                    },
                    footnoteover: function() {
                        clearTimeout(Footnotes.footnotetimeout);
                        jQuery('#footnotediv').stop();
                        jQuery('#footnotediv').remove();
        
                             //old way doesn't work in wordpress, since wp adds the whole URL to href anchors
                             // so we must use the next lines to strip off the anchor name to set the id.
                             var hash = this.href.split( '#' ); // Get the ID for the footnote
                             id = hash.pop( ); 			// now the hash is the ID
                             //id = decodeURIComponent(id);			// in case our id is an ansi char
                            if (decodeURIComponent(id)) {id = decodeURIComponent(id);}
        
                                        var position = jQuery(this).offset();
        
                                        var div = jQuery(document.createElement('div'));
                                        div.attr('id','footnotediv');
                                        div.bind('mouseover',Footnotes.divover);
                                        div.bind('mouseout',Footnotes.footnoteoout);
        
                                        var el = document.getElementById(id);
                                        div.html(jQuery(el).html());
        
                                        jQuery(document.body).append(div);
        
                             // logic to decide how big to make div's and whether to add scroll bars
                             var width = (div.width()>'400') ? '400px' : '';
                             if (div.height() > '110') {
                                     var height = '150px';
                                 var flowy = 'auto';
                                 }
                             else {
                                 //alert(div.height());
                                 var height = '';
                                 var flowy = 'hidden';
                     }
        
                     // if chrome, we need to deactivate opacity because of a scrollbar opacity saturation bug #24524
                     var opaq = (/chrome/.test( navigator.userAgent.toLowerCase())) ? '1.0' : '0.85' ;
        
                        div.css({
                            position:'absolute',
                         overflow:flowy,
                            width:width,
                         height:height,
                            opacity:opaq
                        });
        
                        jQuery(document.body).append(div);
        
                     // logic to assure popup doesnt extend off the browser window side or bottom
                        var left = position.left;
                     var width = (width=='') ? div.width() : 400;      //if tiny, adjust placement
                        if(left + width + 30  > jQuery(window).width() + jQuery(window).scrollLeft())
                            left = jQuery(window).width() - width - 60 + jQuery(window).scrollLeft();
                        var top = position.top+20;
                        if(top + div.height() > jQuery(window).height() + jQuery(window).scrollTop())
                            top = position.top - div.height() - 15;
                        div.css({
                            left:left,
                            top:top
                        });
                    },
                    // controls the disappearance animation of the popup window
                    //.animate( properties, [ duration ], [ easing ], [ complete ])
                    footnoteoout: function() {
                        Footnotes.footnotetimeout = setTimeout(function() {
                            jQuery('#footnotediv').animate({
                                opacity: 0
                            }, 600, function() {
                                jQuery('#footnotediv').remove();
                            });
                        },100);
                    },
                    divover: function() {
                        clearTimeout(Footnotes.footnotetimeout);
                        jQuery('#footnotediv').stop();
                        jQuery('#footnotediv').css({
                                opacity: 1.0
                        });
                    }
                }
            </script>
   <div class="modal inmodal fade" id="add_comment" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title">Комментарий</h4>
                            <small class="font-bold"></small>
                        </div>
                        <div class="modal-body">
                        <div class="form-group">
                        <div class="row">
                        <label hidden="" >Фрагмент текста</label> <input placeholder="Пусто" id="partOfText" class="form-control" style="display: none;"/>
                        <label>Автор</label> <input disabled="" value="<?php echo $active_user_dan['emp_name']; ?>" class="form-control" type="email"/>
                        </div>
                        </div>
                        <div class="row">
                        <div class="social-comment">
                            <div class="media-body">
                                <textarea class="form-control" style="resize: none; height: 100px;" id="partForComment" placeholder="Write comment..."></textarea>
                            </div>
                        </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="saveComment();" data-dismiss="modal">Сохранить</button>
                            <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>                
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal inmodal fade" id="edit_comment" tabindex="-1" role="dialog"  aria-hidden="true">
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
                                <textarea class="form-control partForCommentAns" style="resize: none; height: 100px;" id="partForCommentAns" placeholder="Write comment...">                                </textarea>
                            </div>
                        </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="saveCommentAns();" data-dismiss="modal">Сохранить</button>
                            <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>                
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal inmodal fade" id="add_new_text" tabindex="-1" role="dialog"  aria-hidden="true">
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
                                <textarea id="placeForReplText" autofocus class="form-control placeForReplText"></textarea>
                            </div>
                        </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="button" onclick="add_text();" data-dismiss="modal">Добавить текст</button>
                            <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>                
                        </div>
                    </div>
                </div>
            </div>
            
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