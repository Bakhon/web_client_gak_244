<div class="row">
    <div class="col-sm-12">        
        <div class="ibox float-e-margins">            
            <div class="ibox-content" style="float: left; width: 100%;"> 
                <h2>Список пользователей</h2>
                <span class="pull-right">
                    <a class="btn btn-link btn-sm"><i class="fa fa-database"></i> Обновить базу данных пользователей </a>                         
                </span>
                <p>Список пользователей которые сущесвуют в домене и в базе данных</p>                           
                <div class="col-lg-12">                    
                    <span class="pull-left">
                        <a href="admin_users" class="label label-info">Показать всех</a>
                        <a href="admin_users?current" class="label">Действующие</a> 
                        <a href="admin_users?not_current" class="label label-inverse">Нету в базе</a> 
                        <a href="admin_users?blockeds" class="label label-danger">Заблокированные</a>
                    </span>                                        
                    <br />
                    &nbsp;
                </div>                                    
                
                <div class="col-lg-6">
                    <div style="overflow: auto; width: 100%; height: 600px;">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Логин</th>
                                    <th>ФИО</th>
                                    <th>Почта</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    for($i = 0;$i<$Ldap_Users['count'];$i++){
                                        $s = '';
                                        $b = false;
                                        
                                        foreach($_GET as $t=>$y);
                                        if(empty($t)){$b = true;}
                                        
                                        $u = ACTION::UserdanBase($Ldap_Users[$i]['samaccountname'][0]);
                                        if(count($u) <= 0){
                                            $s = 'label-inverse';                                                                                            
                                        }else{
                                            if($u[0]['BDISABLED'] == '2'){
                                                $s = 'label-warning';
                                            }
                                        }
                                        
                                        if ($Ldap_Users[$i]['useraccountcontrol'][0] == '514'){                                            
                                            $s = 'label-danger';                                            
                                            if(isset($_GET['blockeds'])){$b = true;}
                                        }                        
                                        
                                        if(isset($_GET['current'])){
                                            if(count($u) > 0)
                                            $b = true;
                                        }
                                        
                                        if(isset($_GET['not_current'])){
                                            if(count($u) <= 0){
                                                $b = true;
                                            }
                                        }
                                        
                                        if($b){
                                ?>                                
                                    <tr class="view_user_dan  <?php echo $s; ?>" data="<?php echo $Ldap_Users[$i]['samaccountname'][0]; ?>">
                                        <td><?php echo $i+1; ?></td>
                                        <td><?php echo $Ldap_Users[$i]['samaccountname'][0]; ?></td>
                                        <td><?php echo $Ldap_Users[$i]['sn'][0]." ".$Ldap_Users[$i]['givenname'][0]; ?></td>
                                        <td><?php echo $Ldap_Users[$i]['userprincipalname'][0]; ?></td>                                    
                                    </tr>       
                                <?php 
                                        }
                                    }
                                ?>                     
                            </tbody>
                        </table>
                        </div>
                    </div>  
                
                <div class="col-lg-6">
                    <div id="contact">
                        
                    </div>
                </div>              
                
            </div>
        </div>
    </div>         
</div>

<style>
.view_user_dan{
    cursor: pointer;
}

tr.active{
    color: black;
}
</style>

<script>
$('.view_user_dan').click(function(){
   var id = $(this).attr('data');
   $('.view_user_dan').removeClass('active');
   $(this).addClass('active');
   
   $.post("admin_users", {"user_dan": id}, function(data){
        $('#contact').html(data);
   });   
});

$('body').on('change', '#role', function(){
   var id = $(this).val();
   $.post("admin_users", {
    "list_regions": id
   }, function(data){    
    $('#list_regions').html(data);
   });    
});
</script>

