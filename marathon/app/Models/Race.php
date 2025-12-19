<?php

namespace App\Models;

use CodeIgniter\Model;

class Race extends Model
{
    public function get_races()
    {
        $db = db_connect();
        $sql = "Select * from race";
        $query = $db->query($sql);
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
        try{
            $db = db_connect();
            $sql = "insert into race(raceName, raceLocation, raceDescription, raceDateTime) values(?, ?, ?, ?)";
            $db->query($sql,[$name, $location, $description, $date]);
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