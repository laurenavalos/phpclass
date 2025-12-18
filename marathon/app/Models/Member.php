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
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}