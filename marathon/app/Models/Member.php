<?php

namespace App\Models;

use CodeIgniter\Model;

class Member extends Model
{
    public function user_login($email, $passwd)
    {
        $db = db_connect();
        $sql = "Select memberPassword, memberKey, roleID, memberID from memberLogin where memberEmail = ? and roleID = 2";
        $query = $db->query($sql, [$email]);
        $row = $query->getFirstRow();

        if($row!=null) {
            echo $row->memberKey;

            $DBPass = $row->memberPassword;
            $MemberKey = $row->memberKey;
            $passwd = md5($passwd . $MemberKey);
            if($passwd==$DBPass){
                $this->session = service('session');
                $this->session->start();

                $this->session->set("roleID", $row->roleID);
                $this->session->set("UID", $row->memberID);

                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function create_user($name, $email, $password)
    {
        $db = db_connect();
        $memberKey = 'abc123';
        $hashedPassword = md5($password . $memberKey);

        $sql = "INSERT INTO memberLogin (memberName, memberEmail, memberPassword, memberKey, roleID)
        VALUES (?, ?, ?, ?, 2)";

        $db->query($sql, [$name, $email, $hashedPassword, $memberKey]);

        return true;
    }

}