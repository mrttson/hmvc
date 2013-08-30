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
        $sql = "SELECT MAX(id) AS maxid FROM users";
        $res = $this->getData($sql);
        return $res[0]['maxid'];
    }

}

?>
