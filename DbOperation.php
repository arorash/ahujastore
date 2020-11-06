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
            $stmt->store_result();
            return $stmt->num_rows > 0;
        }

        public function getItems(){
            $stmt = $this->con->prepare("select * from products order by product_name;");
            $stmt->execute();
            return $stmt->get_result()->fetch_all();
        }

        public function insertPro($product_name,$price,$quantity,$category){
            $stmt = $this->con->prepare("insert into products(product_name,price,quantity,category) values(?,?,?,?);");
            $stmt->bind_param("ssss",$product_name,$price,$quantity,$category);
            if($stmt->execute()){
                return 1;
            }
            return 0;
        }

        public function updatePro($product_name,$price,$quantity){
            $pname = explode(",",$product_name);
            $pprice = explode(",",$price);
            $quan = explode(",",$quantity);

            $j=0;
            for($i=0;$i<sizeof($pname);$i++){
                $stmt = $this->con->prepare("update products set quantity=? where product_name=? and price=?;");
                $stmt->bind_param("sss",$quan[$i],$pname[$i],$pprice[$i]);

                if($stmt->execute()){
                    $j++;
                }
            }
            return $j;

        }
        public function insertModify($product_name,$price,$quantity,$modifyD){

            $stmt = $this->con->prepare("insert into modify_records(product_name,product_price,quantity_change,changing_date) values(?,?,?,?);");
            $stmt->bind_param("ssss",$product_name,$price,$quantity,$modifyD);
            if($stmt->execute()){
                return 1;
            }
            return 0;
        }

        public function getModifyItems($modify_date){
            $stmt = $this->con->prepare("select * from modify_records where changing_date=?;");
            $stmt->bind_param("s",$modify_date);
            $stmt->execute();
            return $stmt->get_result()->fetch_all();
        }
    }
