<?php
	function LdapList()
    {   
        $ldap_domain = '@gak.local';
        $ldap_user = 'Администратор';
        $ldap_pass = '<fhsc2014';

        $ds=ldap_connect("192.168.5.201");  // must be a valid LDAP server!
        
        ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
    
        //$dn = "dc=gak, dc=local";
        $dn = "OU=filialy,OU=gak_user,DC=gak,DC=local";
        
        $filter = "sn=*";
        $attr = array('cn', 'mail', 'title', 'department', 'company', 'telephoneNumber', 'mobile', '*');
        if ($ds) 
        {             
            $r=ldap_bind($ds, $ldap_user.$ldap_domain, $ldap_pass) or die("Ошибка авторизации пользователя");
            $result = ldap_search($ds, $dn, $filter, $attr);        
            $r_d = ldap_get_entries($ds, $result);
            ldap_unbind($ds);
        }
        //$dan = $r_d;
        
        $dan = array();            
        for($i = 0;$i<$r_d['count'];$i++)
        {   
            $ds = array();
            if ($r_d[$i]['useraccountcontrol'][0] !== '514'){
                if(isset($r_d[$i]['sn'][0])){
                    $ds['fio'] = $r_d[$i]['sn'][0]." ".$r_d[$i]['givenname'][0];
                    $ds['login'] = $r_d[$i]['samaccountname'][0];   
                }                        
            }                 
            $dan[] = $ds;
        } 
        
        return $dan;   
    }
    echo '<table border=1>
        <tr>
            <th>ФИО</th>
            <th>Логин</th>
            <th>Новый пароль</th>
        </tr>
    ';
    $users =  LdapList();
    foreach($users as $key=>$v){        
        $rd = rand(0, 99);
        $login = str_replace(".", "", $v['login']);
        $bukv = str_split($login);
        $pass = '';
        for($i = 0; $i < count($bukv); $i++){
            $rs = rand(0, count($bukv));
            $pass .= $bukv[$rs];
        }
        $pass .= $rd;
        echo '<tr>
            <td>'.$v['fio'].'</td>
            <td>'.$v['login'].'</td>
            <td>'.$pass.'</td>
        </tr>';        
    }
    echo '</table>';    
?>