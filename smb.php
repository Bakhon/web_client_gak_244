<form action="smb.php" method="post" enctype="multipart/form-data">
    <input type="file" name="userfile"/>
    <input type="submit" value="���������"/>
</form>
<?php
    if(isset($_FILES['userfile'])){
        //declare(encoding="utf-8");
        //declare(filename_encoding="utf-8");
        setlocale(LC_ALL, 'ru_RU.UTF-8');
        
        $uploaddir = "//192.168.5.2/insurance_life_files/";
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
        
        echo '<pre>';
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            echo "���� ��������� � ��� ������� ��������.\n";
        } else {
            echo "��������� ����� � ������� �������� ��������!\n";
        }
        
        echo '��������� ���������� ����������:';
        print_r($_FILES);
        
        print "</pre>";
    }
  exit;	
?>    