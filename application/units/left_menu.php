<?php
	class LEFT_MENU
    {
        private $db;
        private $email;

        public function __construct()
        {
            $this->db = new DB();
            $this->email = $_SESSION[USER_SESSION]['login']."@gak.kz";
        }

        public function init()
        {
            $sql = "select job_position id_DOLZH from sup_person where email = '$this->email' and state in(2, 3, 5)";
            //echo $sql;
            
            $q = $this->db->Select($sql);

            $menu_array = $this->gen_menu($q[0]['ID_DOLZH']);
            return $this->html_menu($menu_array);
        }

        private function gen_menu($id_dolzh)
        {
            $dan = array();

            $q = $this->db->Select("
            select
              dm.id_num,
              dm.id,
              case
                when (select name from dir_menu where id = dm.id_num) is null then dm.name
                else (select name from dir_menu where id = dm.id_num)
              end main_menu,
              case
                when (select name from dir_menu where id = dm.id_num) is null then null
                else dm.name
              end child_menu,
              dm.icon,
              (select icon from dir_menu where id = dm.id_num) icon_main,
              (select name_url from dir_forms where id = DM.ID_FORM) url
            from
              dir_menu dm
            where
              dm.id_num <> 11
              and DM.ID_FORM in(select d.id from DIR_FORM_DOLZH f, dir_forms d where F.ID_FORM = D.ID and F.ID_METHOD = 0 and F.ID_DOLZH = $id_dolzh)
            union all
            select 
                11 id_num,
                null id,
                'Документооборот' main_menu,
                '0' child_menu,
                null icon,
                'fa fa-rocket' icon_main,
                null url
             from dual
             order by 1, 2
            ");
            //echo $this->db->sql;
            return $q;
        }

        private function html_menu($dan)
        {
            $main = '';
            $html = '';
            $close_ul = '';        

            foreach($dan as $k=>$v)
            {
                $ids = '';
                if($v['ID_NUM'] == '11'){
                    $ids = 'id="documentooborot"';
                }                
                if(trim($v['MAIN_MENU']) !== $main)
                {
                    if($close_ul !== '')
                    {
                        $html .= $close_ul."</li>";
                    }

                    $html .= "<li $ids>";

                    if(trim($v['CHILD_MENU']) == '')
                    {
                        $html .= '<a href="'.$v['URL'].'"><i class="'.$v['ICON'].'"></i> <span class="nav-label">'.$v['MAIN_MENU'].'</span></a>';
                        $close_ul = "</li>";
                    }
                        else
                    {
                        $html .= '<a><i class="'.$v['ICON_MAIN'].'"></i> <span class="nav-label">'.$v['MAIN_MENU'].'</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">';

                        if($v['ID_NUM'] == '11')
                        {
                            require_once 'application/blocks/docs_menu.php';
                            $html .= $menu_html;
                        }
                            else
                        {
                            $html .= '<li class="doc_syst" id="doc_syst"><a href="'.$v['URL'].'"><i class="'.$v['ICON'].'"></i>'.$v['CHILD_MENU'].'</a></li>';    
                        }                                                            
                        $close_ul = '</ul>';
                    }
                }
                    else
                {
                    if(trim($v['CHILD_MENU']) !== '')
                    {
                        if($v['ID_NUM'] == '11')
                        {
                            $html .= '<li><a href="#"><i class="'.$v['ICON'].'"></i>HELLO</a></li>';
                        }
                            else
                        {
                            $html .= '<li><a href="'.$v['URL'].'"><i class="'.$v['ICON'].'"></i>'.$v['CHILD_MENU'].'</a></li>';    
                        }
                    }
                }
                $main = trim($v['MAIN_MENU']);
            }
            return $html;
        }
    }