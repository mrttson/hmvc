<?php

require_once(APPPATH . 'models/commonmodel.php');

class MyteamModel extends CommonModel {

    public function __construct() {
        parent::__construct();
    }

    function getImg($id){
        $sql = "SELECT 
                    img_name
                FROM myteam_img
                WHERE mid = '".$id."'";
        return $data = $this->getData($sql);
    }
    
    function getListMemberInfo(){
        
    }
    
}

?>
