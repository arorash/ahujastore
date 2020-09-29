<?php
    class DbOperation{
        private $con;
        function __construct()
        {
            require_once dirname(__FILE__).'/DBConnect.php';
            $db = new DBConnect();
            $this->con = $db->connect();
        }

        public function getAdminDetails($username,$password){
            $stmt = $this->con->prepare("select id from admin_table where username=? and password=?;");
            $stmt->bind_param("ss",$username,$password);
            $stmt->execute();
            return $stmt->num_rows > 0;
        }

        public function getItemsId(){
            $stmt = $this->con->prepare("select id from products order by id;");
            $stmt->execute();
            return $stmt->get_result()->fetch_all();
        }
    }