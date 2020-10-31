<?php
    require_once dirname(__FILE__).'/DbOperation.php';
    $response = array();
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_POST['product_name']) and isset($_POST['price']) and isset($_POST['quantity']) and isset($_POST['category'])){
            $db = new DbOperation();
            if($db->insertPro($_POST['product_name'],$_POST['price'],$_POST['quantity'],$_POST['category'])){
                $response['error']=false;
                $response['message']="Added Successfully";
            }
            else{
                $response['error']=true;
                $response['message']="Item not added.";
            }
        }
        else{
            $response['error']=true;
            $response['message']="Enter the missing fields.";
        }
    }
    else{
        $response['error']=true;
        $response['message']="Invalid Request.";
    }


    echo json_encode($response);
