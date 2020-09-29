<?php
    require_once dirname(__FILE__).'/DbOperation.php';
    $response = array();
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_POST['username'])){
            $db = new DbOperation();
            $products = $db->getItems();
            for($i=0;$i<count($products);$i++){
                array_push($response,$products[$i]);
            }
            
        }

    }
    else{
        $response['error']=true;
        $response['message']="Invalid Request";
    }
    echo json_encode($response);
