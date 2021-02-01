<?php    
    
    $mailbox = new IMAPMAIL(MAIL_SERVER_IP, $_SESSION[USER_SESSION]['mail'], base64_decode($_SESSION[USER_SESSION]['password']));        
    $msgNo = 0;
    if(isset($_GET['msgno'])){
        $msgNo = $_GET['msgno'];
    }
    $folder = 'INBOX';
    
    if(isset($_GET['path'])){
        $folder = $_GET['path'];        
    }    
    
    /*Если был запрос на получение заговок списка писем в папке*/       
    if($msgNo == 0){ 
        $list_msg = $mailbox->list_messages_from_path($folder);
                            
        if($list_msg['count'] == 0){
            echo '<div style="text-align: center;"><h1>В папке нету писем</h1></div>';
            exit;
        }
        
        $file = '';
        
        echo '<ul class="sortable-list agile-list ">';
        foreach($list_msg['messages'] as $k=>$m)
        {    
            
            $to_adress = $m['to'];
            $toAdress = '';
            foreach($toAdress as $ts){
                $toAdress .= $ts." "; 
            }
                 
            $subject = $m['subject'];              
            if(trim($subject) == ''){
                $subject = '<span class="emptyTextSubject">(Без темы)</span>';
            }
            
            $maildate = date("d.m.Y H:i:s", strtotime($m['date']));
            $flag = 'fa-star-o';
            
            //if(trim($header->Flagged) !== ''){$flag = 'fa-star';}        
            
            $unsubscrib = '';
            if(trim($m['unread']) !== ''){
                $unsubscrib = 'unsubsrib';
            }
            
            echo '<li class="mail-body" id="'.$unsubscrib.'" data="path='.$folder.'&&msgno='.$m['uid'].'">
                <strong>'.$m['from'].'</strong>
                <span class="pull-right">'.$file.'</i></span>
                <br />'.$subject.'
                <div class="agile-detail">
                    <span class="pull-right btn btn-xs"><i class="fa '.$flag.'"></i></span>
                    <i class="fa fa-clock-o"></i> '.$maildate.'
                </div>
            </li>';            
            
        }
        echo "</ul>";        
    }else{        
        $ds = $mailbox->MessageDan($folder, $msgNo);
                
        $from = $ds['from'];
        $to = '';
        $subject = $ds['subject'];              
        if(trim($subject) == ''){
            $subject = '<span class="emptyTextSubject">(Без темы)</span>';
        }
        $txt = $ds['body'];
        $date = date("d.m.Y H:i:s", strtotime($ds['date']));
            
        $output = '
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed">'.$subject.' 
                        <br />'.$from.' ('.$date.')</a>
                    </h5>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div>От: '.$from.'</div>
                        <div>Кому: '.$to.'</div>
                        <div>Дата: '.$date.'</div>
                    </div>
                </div>
            </div>
        </div>';
        
        $output.= '<div class="col-lg-12">'.$txt.'</div><hr />';
        echo $output;                            
    }
    exit;
?>