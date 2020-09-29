<?php
    require_once dirname(__FILE__).'/DbOperation.php';
    $response = array();
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_POST['username']) and isset($_POST['password'])){
            $db = new DbOperation();
            if($db->getAdminDetails($_POST['username'],$_POST['password'])){
                $response['error']=false;
                $response['message']="Login Successfully";
            }
            else{
                $response['error']=true;
                $response['message']="Wrong Password";
            }
        }
        else{
            $response['error']=true;
            $response['message']="Enter the username/password";
        }
    }
    else{
        $response['error']=true;
        $response['message']="Invalid Request";
    }

    echo json_encode($response);