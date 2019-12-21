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
         //hiện danh sách các môn đăng kí 
         public function selectMonDk()
         {
             # code...
             $sql = "select * from mondkthi";
            return $this->execute($sql);
         }
         // thêm môn đăng kí thi
         public function insertMonDk($maMon)
         {
             # code...
             $sql = "insert into lichthi(maMon) values('$maMon')";
             return $this->execute($sql);

         }
         // check môn thi đã được đăng kí hay chưa
         public function checkMonDk($maMon)
         {
             # code...
             $sql = "select count(maLichThi) as count from lichthi where maMon = '$maMon'";
             $this->execute($sql);
             $data = $this->getData();
             return $data;
         }
         // đếm số kì thi đã đăng kí
         public function countKiThi()
         {
             # code...
             $sql = "select count(*) as count_lt from lichthi";
             $this->execute($sql);
             $data = $this->getData();
             return $data;
         }
         // hiện danh sách lịch thi
         public function selectLichThi()
         {
             # code...
             $sql = "select * from mondkthi m inner join lichthi lt on m.maMon = lt.maMon";
             return $this->execute($sql);
         }
    }
    
?>  