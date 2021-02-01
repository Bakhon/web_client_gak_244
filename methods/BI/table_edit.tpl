<div id="{%id%}" class="panel_table" style="border: solid 1px #c3c3c5;padding: 10px;">
    <div class="menu_table" id="m{%id%}">
        <a class="btn btn-danger pull-right delete" data="{%id%}"><i class="fa fa-trash"></i></a>
        <a class="btn btn-white block_col" data="{%id%}" title="Заблокировать/Разблокировать колонку для отображения ее в графике"><i class="fa fa-lock"></i></a>
        <a class="btn btn-white sql_lists" data-toggle="modal" data-target="#modal_sql_lists" data="{%id%}"><i class="fa fa-database" title="Список SQL запросов"></i></a>        
        <a href="bi1?sql_editor_block=0" target="_blank" class="btn btn-white add_sql_list"><i class="fa fa-plus-circle" title="Создать SQL запросов"></i></a>
        <a class="btn btn-white align_left" data="{%id%}"><i class="fa fa-align-left"></i></a>
        <a class="btn btn-white align_center" data="{%id%}"><i class="fa fa-align-center"></i></a>
        <a class="btn btn-white align_right" data="{%id%}"><i class="fa fa-align-right"></i></a>
    </div>
    <div class="edit_table" contenteditable="true">
        {%table%}
    </div>
    <div class="others_dan">{%others%}</div>
</div>