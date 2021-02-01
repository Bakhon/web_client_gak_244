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
	return {x:x, y:y}
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
    insertHTML('<span class="meta" contenteditable="false" data-table="'+dt+'" data-col="'+dc+'">'+m+'</span> &nbsp;');         
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