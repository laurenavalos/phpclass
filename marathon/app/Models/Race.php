<?php

namespace App\Models;

use CodeIgniter\Model;

class Race extends Model
{
    public function get_races($memberKey)
    {
        $memberKey = $this->session->get("memberKey");

        $db = db_connect();
        $sql = "select r.raceID, raceName, raceLocation, raceDescription, raceDateTime from race r inner join member_race mr on r.raceID = mr.raceID inner join memberLogin ml on mr.memberID = ml.memberID where ml.memberKey = '$memberKey' and mr.roleID = '1';";
        $query = $db->query($sql);
        return $query->getResultArray();
    }
    public function get_runners($memberKey, $RaceID)
    {
        $memberKey = $this->session->get("memberKey");

        $db = db_connect();
        $sql = "select ml.memberPassword, ml.memberEmail, ml.memberID, mr.roleID from member_race mr inner join memberLogin ml on mr.memberID = ml.memberID where ml.memberKey = ? and mr.raceID = ? and mr.roleID = '3' ;";
        $query = $db->query($sql, [$memberKey, $RaceID]);
        return $query->getResultArray();
    }

    public function get_race($id)
    {
        $db = db_connect();
        $sql = "Select * from race where raceID = ?";
        $query = $db->query($sql, [$id]);
        return $query ->getResultArray();
    }

    public function add_race($name,$location,$description,$date)
    {
        $this->session = service('session');
        $this->session->start();

        $memberID = $this->session->get("memberID");

        try{

            $db = db_connect();
            $sql = "insert into race(raceName, raceLocation, raceDescription, raceDateTime) values(?, ?, ?, ?)";
            $db->query($sql,[$name, $location, $description, $date]);

            $sql = "Select LAST_INSERT_ID()";
            $query = $db->query($sql);
            $row = $query->getResultArray();
            $LastID = $row[0]["LAST_INSERT_ID()"];

            $sql = "insert into member_race(memberID, raceID, roleID) values( ?, ?, 2)";
            $db->query($sql, [$memberID, $LastID]);

            echo $LastID[0]["LAST_INSERT_ID()"];
            exit();


            return true;
        }catch(Exception $ex){
            return false;
        }
    }
    public function delete_race($id)
    {
        try{
            $db = db_connect();
            $sql = "delete from race where raceID = ?";
            $db->query($sql,[$id]);
            return true;
        }catch(Exception $ex){
            return false;
        }
    }

    public function update_race($name,$location,$description,$date, $txtID)
    {
        try{
            $db = db_connect();
            $sql = "update race set raceName = ?, raceLocation = ?, raceDescription = ?, raceDateTime = ? where raceID = ?";
            $db->query($sql,[$name, $location, $description, $date, $txtID]);
            return true;
        }catch(Exception $ex){
            return false;
        }
    }
}