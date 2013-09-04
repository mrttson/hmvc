<?php

require_once(APPPATH . 'models/CommonModel.php');

class UserModel extends CommonModel {

    public function __construct() {
        parent::__construct();
    }

    function getUserInfo($username = NULL, $password = NULL) {
        if (!empty($username) && !empty($password)) {
            $sql = "SELECT * FROM users
                    WHERE
                        username = '" . $username . "'
                        and password = '" . md5($password) . "'";
            return $res = $this->get1Row($sql);
        } else {
            return FALSE;
        }
    }

    function getUserInfoById($id = NULL) {
        if (!empty($id)) {
            $sql = "SELECT 
                        u.id, u.username, u.fullname, u.email, u.role, u.avatar, u.slogan, r.role_name
                    FROM users u
                    LEFT JOIN roles r ON u.role = r.id
                    WHERE u.id = '" . $id . "'";
            return $res = $this->get1Row($sql);
        } else {
            return FALSE;
        }
    }

    function getIdMax() {
        $sql = "SELECT 
                    MAX(id) AS maxid 
                FROM users";
        $res = $this->getData($sql);
        return $res[0]['maxid'];
    }

    function getListRole() {
        $sql = 'SELECT 
                    id, role_name
                FROM roles';
        $res = $this->getData($sql);
        if ($res) {
            return $res;
        } else {
            return FALSE;
        }
    }

    function add($data) {
        $sql = "INSERT INTO users(username, password, fullname, email, role)
                VALUES('" . $data['username'] . "', '" . md5($data['password']) . "', '" . $data['fullname'] . "', '" . $data['email'] . "', '" . $data['role'] . "')";
        if ($this->Execute($sql)) {
            return $this->getIdMax();
        } else {
            return FALSE;
        }
    }

    function getListUserInfo() {
        $sql = "SELECT 
                    u.id, u.username, u.fullname, u.email, r.role_name
                FROM users u
                LEFT JOIN roles r ON u.role = r.id";
        $res = $this->getData($sql);
        if ($res) {
            return $res;
        } else {
            return FALSE;
        }
    }

    function update($data){
        $sql = "UPDATE users 
                SET 
                    fullname = '".$data['fullname']."',
                    email = '".$data['email']."',
                    role = '".$data['role']."'
                WHERE
                    id = '".$data['id']."'
                    ";
        if($this->Execute($sql)){
            return $data['id'];
        } else {
            return FALSE;
        }
    }
    
    function delete($id){
        $sql = "DELETE FROM 
                        users
                    WHERE
                        id = '".$id."'";
        if($this->Execute($sql)){
            return $id;
        } else {
            return FALSE;
        }
    }
    
}

?>
