<?php 
    
    if(isset($_GET['action'])){
        $action = $_GET['action'];
    }else{
        $action = '';
    }

    
    switch($action){
        case 'login':{

            if(isset($_POST['dangnhap'])){
                $masv = $_POST['maSv'];
                $matkhau = $_POST['passWord'];
                $num = $db->loginAccept($masv , $matkhau);
                sleep(2);
                
                if($num >0){
                    $_SESSION['daDangNhap'] = $masv;
                    header('location:index.php?controller=actor&action=lichthi');
                }
                else{
                    ?>
                    <script type = "text/javascript">
                        alert("Mã sinh viên hoặc Mật khẩu không chính xác !!!");
                     </script>
                    <?php
                }
            }

            require_once('view/login.php');
        break;
        }
        case 'lichthi':{
            $masv = null;
            if(isset($_SESSION['daDangNhap'])){
                $masv = $_SESSION['daDangNhap'];
            }
            // lấy thông tin người dùng
            $infor = $db->getActor($masv);
            $hoTen = $infor["hoTen"];
            
            
            // hiện danh sách môn thi
            $query =  $db->selectLichThi($masv);
            require_once('view/lichThi.php');
        break;
        }
        case 'dangKyThi':{
            $masv = null;
            if(isset($_SESSION['daDangNhap'])){
                $masv = $_SESSION['daDangNhap'];
            }
            // lấy thông tin người dùng
            $infor = $db->getActor($masv);
            $hoTen = $infor["hoTen"];
            // hiện danh sách môn cần đăng kí
            $query =  $db->selectMonDk();
             // thêm môn thi
             $maMon = null;
             if(isset($_GET['add']) && !empty($_GET['add'])){
                $maMon = $_GET['add'];
                $num = $db->checkMonDk($maMon , $masv);
                $count = $num["count"];
                if($count == 0){
                    $db->insertMonDk($maMon , $masv);
                    
                }
            }
            // số môn thi đã đăng kí
            $num_2 = $db->countKiThi($masv);
            $count_2 = $num_2["count_lt"];
            require_once('view/dangKyThi.php');
        break;
        }
        case 'inLichThi':{
            $masv = null;
            if(isset($_SESSION['daDangNhap'])){
                $masv = $_SESSION['daDangNhap'];
            }
            // lấy thông tin người dùng
            $infor = $db->getActor($masv);
            $hoTen = $infor["hoTen"];
            $ngaysinh = $infor["ngaySinh"];
            $nganhhoc = $infor["nganhHoc"];
            $khoa = $infor["khoa"];
            $lop = $infor["lop"];

            // hiện danh sách môn thi
            $query =  $db->selectLichThi($masv);
            require_once('view/inLichThi.php');
        break;
        }
    }
?>