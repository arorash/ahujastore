<?php
    require_once dirname(__FILE__).'/DbOperation.php';
    $response = array();
    /*if($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_POST['product_name']) and isset($_POST['price']) and isset($_POST['quantity'])){
            $db = new DbOperation();

        }
        else{
            $response['error']=true;
            $response['message']="Data is missing";
        }
    }
    else{
        $response['error']=true;
        $response['message']="Invalid Request.";
    }*/
    if($db->updatePro("PARLE,GOODDAY","5,10","10,5")){
        $response['error']=false;
        $response['message']="Save Successfully";
    }
    else{
        $response['error']=true;
        $response['message']="Some Error Occur";
    }

    echo json_encode($response);
