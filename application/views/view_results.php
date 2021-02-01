<div class="wrap">
 <div class="ibox">
    <div class="ibox-content inspinia-timeline">
    <div class="">
      <h3 align="center">Результаты тестирования</h3>
    </div>
        <form>
                <div class="form-group">
                
                    <label class="font-noraml">Выберите тест</label>
                                                                                    
                    <select name="id" class="select2_demo_1 form-control" id="id_type" required>
                        <option value=""></option>
                        <?php 
                            foreach($list_project as $y => $u) { ?>
                            
                                <option value="<?php echo $u['ID']; ?>"><?php echo $u['NAME']; ?></option>                                
                        <?php  
                            } 
                        ?>                                    
                    </select>                                                        
                </div>
                
                <div>
                    <button type="submit" class="center btn" id="button">Показать результаты</button> 
                </div>   
        </form>  
                                                                                           
        <div class="panel-group" style="margin-top: 50px;">                              
                    <div class="result" id="res"></div>                                                         
        </div>   
    </div>                                                    
  </div>
</div>
    
<script>

var projects = '<?php echo json_encode($list_project); ?>';
var list_users_result = '<?php echo json_encode($list_users_result); ?>';
var kind_project =  '<?php echo json_encode($qs); ?>';
          
    $("form").submit(function(e) {        
    e.preventDefault();
    $('#res').html('');
                   
    $.ajax({        
        url: "application/controller/contr_results.php",
        datatype: "html", 
        type: "POST",
        data: $("form").serialize(),
    
    success: function(data, textStatus) {
        $('#res').append(textStatus+':'+'Всё ок'+'<br/>'); 
					},                                         
		error: function(){
				alert('Error!');                                
			}                                                                                                                                                                                                              
});
});

</script>






