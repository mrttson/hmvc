<?php
require_once(APPPATH . 'models/CommonModel.php');
class UserModel extends CommonModel {

    public function __construct() {
        parent::__construct();
    }

    function getUserInfo($id = NULL, $username = NULL, $password = NULL) {
        if (!empty($id)){
            $sql = "SELECT * FROM users
                    WHERE 
                        id = '".$id."'";
            return $res = $this->getData($sql);
        } else if (!empty ($username) && !empty ($password)) {
            $sql = "SELECT * FROM users
                    WHERE
                        username = '".$username."'
                        and password = '".  md5($password)."'";
            return $res = $this->getData($sql);
        } else {
            return FALSE;
        }
    }
    
    function getIdMax(){
        $sql = "SELECT 
                    MAX(id) AS maxid 
                FROM users";
        $res = $this->getData($sql);
        return $res[0]['maxid'];
    }

    function getListRole(){
        $sql = 'SELECT 
                    id, role_name
                FROM roles';
        $res = $this->getData($sql);
        if($res){
            return $res;
        } else {
            return FALSE;
        }
    }
    
    function add($data){
        $sql = "INSERT INTO users(username, password, fullname, email, role)
                VALUES('". $data['username'] ."', '". md5($data['password']) ."', '". $data['fullname'] ."', '". $data['email'] ."', '". $data['role'] ."')";
        if($this->Execute($sql)){
            return $this->getIdMax();
        } else {
            return FALSE;
        }
    }
    
    function getListUserInfo(){
        $sql = "SELECT 
                    u.id, u.username, u.fullname, u.email, r.role_name
                FROM users u
                LEFT JOIN roles r ON u.role = r.id";
        $res = $this->getData($sql);
        if ($res){
            return $res;
        }  else {
            return FALSE;
        }
        
    }
        
}

?>
