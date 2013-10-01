<?php

require_once(APPPATH . 'models/commonmodel.php');

class MyteamModel extends CommonModel {

    public function __construct() {
        parent::__construct();
    }

    function getImg($id) {
        $sql = "SELECT 
                    img_name
                FROM myteam_img
                WHERE mid = '" . $id . "'";
        return $this->getData($sql);
    }

    function getListMemberInfo() {
        $sql = "SELECT
                    id, `name`, avatar
                FROM myteam";
        return $this->getData($sql);
    }

    function getMemberInfoById($id) {
        $sql = "        SELECT m.id, m.`name`,i.thumb_path, i.img_path as avatar
                        FROM myteam m
                        LEFT JOIN images i ON m.avatar = i.id
                        WHERE m.id = '" . $id . "'";
        $sqlAlbum = "   SELECT 
                            mi.id, i.img_path, i.thumb_path
                        FROM myteam_img mi
                        LEFT JOIN images i ON mi.img_id = i.id
                        WHERE mi.mid = '" . $id . "'";
        $data['info'] = $this->get1Row($sql);
        $data['album'] = $this->getData($sqlAlbum);
        return $data;
    }
    
    function updateAlbum($data) {
        $sql = "INSERT INTO 
                    myteam_img(img_id,mid) 
                VALUES ";
        //var_dump($data['album']);die();
        foreach ($data['album'] as $key => $imgId){
            $sql .= "('". $imgId ."','". $data['mid'] ."'),";
        }
        $sql = trim($sql, ",");
        return $this->Execute($sql);
    }

}

?>
