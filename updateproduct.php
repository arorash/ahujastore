<?php
    require_once dirname(__FILE__).'/DbOperation.php';
    $response = array();
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_POST['product_name']) and isset($_POST['price']) and isset($_POST['quantity'])){
            $db = new DbOperation();
            if($db->updatePro($_POST['product_name'],$_POST['price'],$_POST['quantity'])){
                $response['error']=false;
                $response['message']="Save Successfully";
            }
            else{
                $response['error']=true;
                $response['message']="Some Error Occur";
            }
        }
        else{
            $response['error']=true;
            $response['message']="Data is missing";
        }
    }
    else{
        $response['error']=true;
        $response['message']="Invalid Request.";
    }


    echo json_encode($response);