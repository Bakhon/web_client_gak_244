<div class="row">
    <div class="col-lg-6">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div id="jstree1">
                    <ul>
                    <?php 
                        foreach($dan as $k=>$v){
                            echo '<li class="jstree-open">'.$v['NAME'];
                            if(isset($v['departments'])){                                
                                echo '<ul>';
                                foreach($v['departments'] as $a=>$d)
                                {
                                    echo '<li class="jstree-open">'.$d['NAME'].'<ul>';                                    
                                    foreach($d['dolzh'] as $i=>$z){
                                        echo "<li onclick='forms_dolzh(".$z['ID'].")' data-jstree='{".'"type":"dolzh"'."}'>".$z['D_NAME']."</li>";
                                    }
                                    echo '</ul></li>';
                                }
                                echo '</ul>';
                            }else{
                                echo '<ul>';
                                foreach($v['dolzh'] as $a=>$d){
                                    echo "<li onclick='forms_dolzh(".$d['ID'].")' data-jstree='{".'"type":"dolzh"'."}'>".$d['D_NAME']."</li>";
                                }
                                echo '</ul>';
                            }
                            echo '</li>';
                        }
                    ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6">
        <div class="ibox float-e-margins">
            <div class="ibox-content" id="forms">
            </div>
        </div>
    </div>
</div>
<script>
    function forms_dolzh(id)
    {
        $.post(window.location.href, {"forms_dolzh": id}, function(data)
        {
            $('#forms').html(data);
        });        
    }

    $('body').on('change', '.id_method', function()
    {
        var text = $(this).val();
        var p = $(this).prop('checked');
        $.post(window.location.href, {"emp": p, "set_form_user": text}, function(data)
        {
             $('#forms').html(data);
        });
    });

    var h = $(window).height()-250;
    $('#jstree1').attr('style', 'height:820px;overflow: auto;');
    $('#forms').attr('style', 'height:820px;overflow: auto;');
    console.log(h);
</script>
<style>
/*
#forms, #jstree1{
    height: 460px;
    overflow: auto;
}
*/
</style>