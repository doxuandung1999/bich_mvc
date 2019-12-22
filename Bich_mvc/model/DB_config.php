<?php

    class database{
        private $hostName = 'localhost:3306';
        private $userName = 'root';
        private $pass = '';
        private $dbName = 'bich_mvc';
        
        private $conn = null;
        private $result = null;

         // kết nối database
         public function connect()
         {
             # code...
             $this->conn = new mysqli($this->hostName , $this->userName , $this->pass , $this->dbName);
             if(!$this->conn){
                 echo "kết nối thất bại";
             }else{
                 mysqli_set_charset($this->conn , 'utf8');
             }
             return $this->conn;
         }
         // thực thi câu lệnh truy vấn
         public function execute($sql)
         {
             # code...
             $this->result = $this->conn->query($sql);
             return $this->result;
         }
         // phương thức lấy dữ liệu
         public function getData()
         {
             # code...
             if($this->result){
                 $data = mysqli_fetch_array($this->result);
             }
             else{
                 $data = 0;
             }
             return $data;
         }
         // phương thức lấy toàn bộ dữ liệu
         public function getAllData($table)
         {
             # code...
             $sql = "select * from $table";
             $this->execute($sql);
             if($this->numRow() == 0){
                 $data = 0;
             }else{
                 while($datas = $this->getData()){
                     $data[] = $datas;
                 }
             }
             return $data;
         }
           // phương thức đếm số lượng bản ghi
        public function numRow()
        {
            if($this->result){
                $num = mysqli_num_rows($this->result);
            }else{
                $num = 0;
            }
            return $num;
        }
         //hiện danh sách các môn đăng kí 
         public function selectMonDk()
         {
             # code...
             $sql = "select * from mondkthi";
            return $this->execute($sql);
         }
         // thêm môn đăng kí thi
         public function insertMonDk($maMon , $masv)
         {
             # code...
             $sql = "insert into lichthi(maMon , maSv) values('$maMon' , '$masv')";
             return $this->execute($sql);

         }
         // check môn thi đã được đăng kí hay chưa
         public function checkMonDk($masv , $maMon)
         {
             # code...
             $sql = "select count(maLichThi) as count from lichthi where maMon = '$maMon' and maSv = '$masv'";
             $this->execute($sql);
             $data = $this->getData();
             return $data;
         }
         // đếm số kì thi đã đăng kí
         public function countKiThi($masv)
         {
             # code...
             $sql = "select count(*) as count_lt from lichthi where maSv = '$masv'";
             $this->execute($sql);
             $data = $this->getData();
             return $data;
         }
         // hiện danh sách lịch thi
         public function selectLichThi($masv)
         {
             # code...
             $sql = "select * from mondkthi m inner join lichthi lt on m.maMon = lt.maMon where lt.maSv = '$masv'";
             return $this->execute($sql);
         }
         // đếm số người đăng kí
         public function countActor($maMon)
         {
             # code...
             $sql = "select count(maMon) as count from lichthi where maMon= '$maMon'";
             $this->execute($sql);
             $data = $this->getData();
             return $data;

         }
         // xác minh tài khoản đăng nhập
        public function loginAccept($masv , $password)
        {
            # code...
            $sql = "select * from sinhvien where maSv = '$masv' and passWord = '$password'";
            $this->execute($sql);
            $num = $this->numRow();
            return $num;
        }
         // lấy thông tin tài khoản đang đăng nhập
         public function getActor($masv)
         {
             # code...
             $sql = "select * from sinhvien where maSv = '$masv'";
             $this->execute($sql);
             $data = $this->getData();
             return $data;
         }
         
    }
    
?>  