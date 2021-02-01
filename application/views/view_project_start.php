
<?php 
$users_frends = array('b.abdisamat', 't.khamitov', 'a.utepova', 'a.omarov', 'a.saleev', 'a.bekturov', 'i.gabdusheva', 's.gergilevich', 'n.omirbekov', 'n.kurmangozhin');
$tst = false;
foreach($users_frends as $u){
    if($u == $_SESSION[USER_SESSION]['login'])
    {
        $tst = true;
    }
}

if(isset($_GET['proj_id'])){
    $pr_i = $_GET['proj_id'];
    $list_projec  = $db->Select("select * from project where id=$pr_i");
    
    $em = $_SESSION[USER_SESSION]['login'].'@gak.kz';            
          $q = $db->Select("select * from sup_person where email = '$em' and state = 2");

          $id_user = $q[0]['ID'];
          $list_red = $db->Select("select count(*) from USERS_RESULT ID_USER where ID_USER = $id_user and ID_PROJECT = $pr_i");
          $dd = $list_red[0]['COUNT(*)'];
         if($dd == 0)
         {
            foreach($list_projec as $k=>$v)
            {
                    if($v['ID_TYPE'] == '1')
                    { 
                        $date = date('Y-m-d H:i:s');
                        if(empty($_SESSION['time']))
                        {
                            $_SESSION['time'] = $date;
                        }
                    }
            }
        }
else{
 exit;
              
   
}
}
?>
<div class="wrap">
        <div class="ibox">
            <div class="ibox-title">
                <h5><a href="project_start">Список проектов</a></h5>
            </div>
            <div class="ibox-content inspinia-timeline">
                <?php foreach($list_project as $k=>$v){                              
             ?>
                <p>
                    <a href="?proj_id=<?php echo $v['ID'];?>">
                        <?php echo $v['NAME']; ?>
                    </a>
                </p>
                <?php } ?>
            </div>
        </div>
  <div class="ibox" style="position: fixed;right: 120px;">
    <div class="">
                    <div class="clock"></div>
    </div>
 </div>                              
        <div class="ibox">
            <div class="ibox-content inspinia-timeline">
                <div class="content">
                <?php if(isset($_GET['proj_id'])) {                     
                    ?>
                    <p>Количество вопросов:
                        <?php echo count($l_que); ?>
                    </p>
                    <span class="none" id="project-id"><?php echo $_GET['proj_id'];?></span>
                    <hr/>
                    <form method="post" action="">
                        <div class="project-data">
                        <input name="pr_id" type="hidden" value="<?php echo $_GET['proj_id']; ?>" />
                            <?php                             
                            foreach($l_que as $k => $v) 
                            {
                            $q_id = $v['ID'];
                            ?>
                            <div class="question" data-id="<?php echo $v['ID'];?>" id="question-<?php echo $v['ID'];?>">
                            <p class="q">
                                <?php echo $v['QUESTION']; ?>
                            </p>
                            <?php
                    $options = "select * From RESULT_P where ID_QUESTION = $q_id";
                    $l_options = $db -> select($options);
                    foreach($l_options as $q => $r)
                    {
                        if($tst){                                    
                            if($r['CORRECT_ANSWER'] == 1){                                  
                                $r['ANSWER'] .= '.';
                            }                           
                        }  
                ?>
                                <p class="a">
                                    <input type="radio" id="<?php echo $r['ID']; ?>" name="<?php echo $r['ID_QUESTION']; ?>" value="<?php echo $r['ID']; ?>" required>
                                    <label for="<?php echo $r['ID']; ?>"><?php echo $r['ANSWER']; ?></label>
                                </p>
                                
                                <?php
                    }
                ?>
                </div>
                                    <hr />
                                    <?php                                                                                                                                                                                         
                } 
                ?>                        
                        </div>
                        <div class="buttons">
                            <input type="hidden" value="<?php echo $v['ID']; ?>" />
                            <button type="submit" name="endtest" class="center btn " id="btn">Завершить</button>
                        </div>
                    </form>
                    
                <?php } else {
                echo "Выберите проект";
                }?>
                </div>
            </div>
        </div>
   </div> 
<?php 
if(isset($_GET['proj_id'])){
        $pr_i = $_GET['proj_id'];
    $list_project  = $db->Select("select * from project where id=$pr_i");
    
    
    foreach($list_project as $k=>$v) {
        if($v['ID_TYPE'] == '1') {
?>   
    <script src="styles/js/flipclock.js"></script>
    <script>
        var clock;
			
			//$(document).ready(function() {
				// Set dates.
                var ds = '<?php                    
                    $dend = date("Y-m-d H:i:s", strtotime("+25 minutes", strtotime($_SESSION['time'])));                    
                    echo $dend; 
                ?>';
                console.log(ds);
				var futureDate  = new Date(ds);
				var currentDate = new Date();
                console.log(futureDate);
                console.log(currentDate);
                

				// Calculate the difference in seconds between the future and current date
				var diff =futureDate.getTime() / 1000 - currentDate.getTime() / 1000 ;
                console.log(diff);

				// Calculate day difference and apply class to .clock for extra digit styling.
				function dayDiff(first, second) {
					return (second-first)/(1000*60*60*24);
				}

				if (dayDiff(currentDate, futureDate) < 100) {
					$('.clock').addClass('twoDayDigits');
				} else {
					$('.clock').addClass('threeDayDigits');
				}

	 			if(diff < 0) {
					diff = 0;
				}                                 
                if(diff == 0){                  
               //    document.location.href =  'res_full?project_id=<?php echo $pr_i?>';
                }                       
				// Instantiate a coutdown FlipClock
				clock = $('.clock').FlipClock(diff, {
					clockFace: 'MinuteCounter',
					countdown: true
				});
			//});
    </script>  
    
    <script>

$(document).ready(function(){
        $('button[type=submit]').on("click", function(){
            setTimeout(function () {
                $('button[type=submit]').prop('disabled', true);
                }, 0);
            setTimeout(function () {
                $('button[type=submit]').prop('disabled', false);
                }, 5000);
        });
});

</script>
          
<?php }}} ?>
<div class="col-lg-12">
&nbsp;
</div>    