<?php
require_once(APPPATH . 'models/CommonModel.php');
class UserModel extends CommonModel {

    public function __construct() {
        parent::__construct();
    }

    function getUserInfoById($id = NULL) {
        if (!empty($id)){
            $sql = "SELECT * FROM users
                    WHERE 
                        id = '".$id."'";
            return $res = $this->get1Row($sql);
        } else {
            return FALSE;
        }
    }
        
}

?>
