<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Список ролей</h5>     
            </div>
            <div class="ibox-content">
            
        <table class="table table-bordered">
        <thead>
            <tr>
                <td>#</td>
                <td>ФИО отправителя</td>
                <td>Департамент</td>
                <td>Должность</td>                
                <td>URL ссылка</td>
                <td>Дата отправки</td>
                <td>Текст сообщения</td>
                <td colspan="2">ФИО и дата исправления</td>
                <td>Опции</td>
            </tr>
        </thead>
        
        <tbody>
            <?php 
                foreach($list as $k=>$v){
            ?>
            <tr>
                <td><?php echo $v['ID']; ?></td>
                <td><?php echo $v['FIO']." (".$v['EMAIL'].")"; ?></td>
                <td><?php echo $v['DEPARTMENT']; ?></td>
                <td><?php echo $v['DOLGNOST']; ?></td>                
                <td><a href="<?php echo $v['URL_ERROR']; ?>" target="_blank"><?php echo $v['URL_ERROR']; ?></a></td>
                <td><?php echo $v['DATE_ADD']; ?></td>
                <td><?php echo $v['TEXT_ERROR']; ?></td>
                <td><?php echo $v['FIO_ANSWER']; ?></td>
                <td><?php echo $v['DATE_ANSWER']; ?></td>
                <td>
                    <?php 
                        if(trim($v['FIO_ANSWER']) == ''){
                            echo '<a href="#" class="btn btn-block btn-danger set_answer_error" data="'.$v['ID'].'"><i class="fa fa-warning"></i></a>';      
                        }else{
                            echo '<a href="#" class="btn btn-link text-info"><i class="fa fa-check"></i></a>';
                        }
                    ?>                    
                </td>
            </tr>
            <?php
                } 
            ?>            
        </tbody>
        </table>
        </div>
    </div>
</div>    
</div>

<script>
    $('.set_answer_error').click(function(){
        var id = $(this).attr('data');
        $.post(window.location.href, {"set_answer_error":id}, function(data){
           window.location.reload();            
        });
    })
</script>