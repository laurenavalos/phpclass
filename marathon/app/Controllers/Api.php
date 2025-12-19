<?php

namespace App\Controllers;

use App\Models\Member;

class Api extends BaseController
{
    public function get_races($ApiKey){
        $Race = new Race();
        $data = $Race->get_races($ApiKey);
        echo json_encode($data);
        exit();
    }
    public function get_runners($ApiKey, $RaceID){
        $Race = new Race();
        $data = $Race->get_runners($ApiKey, $RaceID);
        exit();
    }
    public function add_runner(){

        $json = json_decode(file_get_contents("php://input"), true);
        $ApiKey = $json["ApiKey"];
        $RaceID = $json["RaceID"];
        $MemberID = $json["MemberID"];
        exit();

        $Member = new Member();
        if($Member->has_access($RaceID, $ApiKey)){
            $Member->Add_user($MemberID, $RaceID);
            echo "Runner Added";
        }else{
            echo "Access Denied";
        }
        $Member->add_user($MemberID, $RaceID);

        echo "Runner Added";
        exit();
    }
    public function delete_runner(){
        $json = json_decode(file_get_contents("php://input"), true);
        $ApiKey = $json["ApiKey"];
        $RaceID = $json["RaceID"];
        $MemberID = $json["MemberID"];
        exit();

        $Member = new Member();
        if($Member->has_access($RaceID, $ApiKey)){
            $Member->delete_user($MemberID, $RaceID);
            echo "Runner Deleted";
        }else{
            echo "Access Denied";
        }
        $Member->add_user($MemberID, $RaceID);

        echo "Runner Added";
        exit();
    }
}