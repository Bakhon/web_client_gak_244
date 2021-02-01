    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Wyswig Summernote Editor</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a>
                        </li>
                        <li><a href="#">Config option 2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content no-padding">

                <div class="summernote">
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

            </div>
        </div>        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Wyswig Summernote Editor</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a>
                        </li>
                        <li><a href="#">Config option 2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content no-padding">

                <div class="summernote">
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

            </div>
        </div>    
        <style>
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
        <div>TODO write content</div>

        <div class="contentarea">

        <p>I have a number of articles with footnotes <a class="fn-ref-mark" href="#footnote-961_1"  id="refmark-961_1"><sup>[1]</sup></a>
            that I wanted to post to my site, but I didn&#8217;t want to reformat them all and manually add the needed html.
            So I tried a number of footnote plugins like FD Footnotes, Footnotes for WordPress, WP-Footnotes and the YAFootnotes
            <a class="fn-ref-mark" href="#footnote-961_2"  id="refmark-961_2"><sup>[2]</sup></a> Plugin, but
            <a class="fn-ref-mark" href="#footnote-961_3"  id="refmark-961_3"><sup>[3]</sup></a> none of them were exactly
            what I wanted.
        </p>
        </div>



      -----------------------------------------
      <p>.</p>
      <p>.</p>
      <p>.</p>
      <p>.</p>
      <p>.</p>
      <p>.</p>

    <div id="footnote-list" style="display: inherit;"><span id="fn-heading">Footnotes</span> &nbsp;&nbsp;&nbsp;(↵ returns to text)</p>
        <ol>
        <li class="fn-text">Such as this one.<a href="#ref-footnote-1" >↵</a></li>
        <li class="fn-text">I liked YaFootnotes because it was so simple and had very compact code<a href="#ref-footnote-2" >↵</a></li>
        <li class="fn-text">Это третья сноска<a href="#ref-footnote-3" >↵</a></li>
        </ol>
    </div>
    <div id="footnote-list" style="display:none;"><span id=fn-heading>Footnotes</span> &nbsp;&nbsp;&nbsp;(&crarr; returns to text)
        <ol>
        <li id="footnote-961_1" class="fn-text">Such as this one.<a href="#refmark-961_1" >&crarr;</a></li>
        <li id="footnote-961_2" class="fn-text">I liked YaFootnotes because it was so simple and had very compact code<a href="#refmark-961_2" >&crarr;</a></li>
        <li id="footnote-961_3" class="fn-text">Это третья сноска<a href="#refmark-961_3" >&crarr;</a></li>
        </ol>
    </div>
    <div class="row">
    <div class="col-lg-12">
           <textarea id="field" name="content" data-provide="markdown" rows="10" class="md-input col-lg-12" style="resize: none;">
           Как получить выделенный текст на JavaScript
            </textarea>
    </div>
    </div>
    <input id="input"/>
    <button id="delete">Delete</button>
        <div class="col-lg-8" id="editPlaceForMetaSelector">
            <div class="form-group has-success"><label class="col-sm-3 control-label">Вставить мету</label>
                <div class="col-sm-9">
                    <select class="select2_demo_1 form-control" name="editAddMeta" id="editAddMeta">
                        <option value="{%meta1%}">{%meta1%}</option>
                        <option value="{%meta2%}">{%meta2%}</option>
                    </select>
                </div>
            </div>
        </div>
        <script type="text/javascript">
        $('#field').select(function() {
            var txt = document.getSelection();
            $('#input').val(txt);
        });
        </script>
        <script>
            $('#delete').click(function(){
                        var delText = $('#input').val();
                        var c = $('#field');
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
                    //this sweet little function lets you modify the popup once the cursor enters it
                    //so lets change the opacity when we hover over it.
                    divover: function() {
                        clearTimeout(Footnotes.footnotetimeout);
                        jQuery('#footnotediv').stop();
                        jQuery('#footnotediv').css({
                                opacity: 1.0
                        });
                    }
                }
            </script>
            <script>
            $(document).ready(function(){
              var edit = true;
              var x, y; 
              $('.test').on('keypress', function(e){     
                 if(edit){
                   if(e = 8){
                    var range = document.createRange();
                    range.setStart(startNode,startOffset);
                    range.setEnd(endNode,endOffset);
                    startRangeNode = range.startContainer;
                    console.log(startRangeNode);
                 }
                  $(this).trigger('focus');
                  insertHTML('<sup>Artur</sup>');  
                  edit = false;  
                }
              });
            
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
            });
            </script>
            <script>
                                        $('#editorsEditContentForClick').click(
                                            function(){
                                                $('#editPlaceForMetaSelector').css('display', 'block');
                                            })
                                    </script>
                                    <script>
                                        $('#saveEdit').click(
                                            function(){
                                                $('#editPlaceForMetaSelector').css('display', 'none');
                                            }
                                        )
                                    </script>
                                    <script>
                                        $('#editAddMeta').change(
                                            function(){
                                                window.selectedMeta = $('#editAddMeta option:selected').val();
                                                
                                                var c = $('.editorsEditContent');
                                                //var c = $('#editorsEditContent');
                                                //var c = $('.note-codable');
                                                //var c = $('.note-editable');
                                                
                                                c.trigger('focus');
                                                insertHTML(selectedMeta);
                                            }
                                        )
                                         
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
                                    $('#saveEdit').click(function(){
                                        var htmlEditorContent = $('#editorsEditContent').html();
                                        $('#edittextAreaForDB').html(htmlEditorContent);
                                        console.log(htmlEditorContent);
                                    })
                                </script>
                                
            <br />
   </body>