<?php 
    
    if(isset($_GET['action'])){
        $action = $_GET['action'];
    }else{
        $action = '';
    }

    
    switch($action){
        case 'lichthi':{
            
            // hiện danh sách môn thi
            $query =  $db->selectLichThi();
            require_once('view/lichThi.php');
        break;
        }
        case 'dangKyThi':{
            // hiện danh sách môn cần đăng kí
            $query =  $db->selectMonDk();
             // thêm môn thi
             if(isset($_GET['add']) && !empty($_GET['add'])){
                $maMon = $_GET['add'];
                $num = $db->checkMonDk($maMon);
                $count = $num["count"];
                if($count == 0){
                    $db->insertMonDk($maMon);
                    
                }
            }

            // số môn thi đã đăng kí
            $num_2 = $db->countKiThi();
            $count_2 = $num_2["count_lt"];
            require_once('view/dangKyThi.php');
        break;
        }
        case 'inLichThi':{
            // hiện danh sách môn thi
            $query =  $db->selectLichThi();
            require_once('view/inLichThi.php');
        break;
        }
    }
?>