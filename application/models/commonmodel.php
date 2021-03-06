<?php

class CommonModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->Execute('set charset utf8');
    }

    /*
     * Common function
     */

    function Execute($sql) {
        return $this->db->query($sql);
    }

    function getData($sql) {
        $tmp = $this->db->query($sql);
        if ($tmp) {
            return $tmp->result_array();
        }
    }

    function get1Row($sql) {
        $tmp = $this->db->query($sql);
        if ($tmp) {
            $data = $tmp->result_array();
            if (count($data) > 0) {
                return $data[0];
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    function get1Cell($sql) {
        $tmp = $this->db->query($sql);
        if ($tmp) {
            $data = $tmp->result_array();
            if (count($data) > 0) {
                $res = array_shift($data[0]); //get first element
                return $res;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    function getIdMax($table_name) {
        $sql = "SELECT 
                    MAX(id) AS maxid 
                FROM " . $table_name;
        $res = $this->get1Cell($sql);
        return $res;
    }
    
    /*
     * Get User Info Data Function
     */

    function getUserInfoData() {
        
    }

    /*
     * Get Layout Data Function
     */

    function getSideBarData() {
        $res = $this->getData('select * from menu');
        $data = array();
        foreach ($res as $menu) {
            if ($menu['parent_id'] == 0 || empty($menu['parent_id'])) {
                $data[$menu['id']] = $menu;
                $data[$menu['id']]['countSub'] = 0;
                foreach ($res as $submenu) {
                    if ($submenu['parent_id'] == $menu['id']) {
                        $data[$menu['id']]['countSub'] +=1;
                    }
                }
            }
        }
        return $data;
    }

    function getAdminSideBarData() {
        $res = $this->getData('select * from systemmenu');
        $data = array();
        foreach ($res as $menu) {
            if ($menu['parent_id'] !== 0) {
                $data[$menu['id']] = $menu;
                $data[$menu['id']]['countSub'] = 0;
                foreach ($res as $submenu) {
                    if ($submenu['parent_id'] == $menu['id']) {
                        $data[$menu['id']]['countSub'] +=1;
                    }
                }
            }
        }
        return $data;
    }

    function getFooterData() {
        $res = $this->get1Row('select * from config');
        return $res;
    }

    function saveImg($data) {
        $imgPath = $data['imagePath'];
        $thumbPath = $data['thumbPath'];
        if (empty($imgPath) || is_null($imgPath) || !file_exists($imgPath)){
            return FALSE;
        } else {
            $sql = sprintf("INSERT INTO images(img_path, thumb_path) 
                    VALUES ('%s','%s')", mysql_real_escape_string($imgPath), mysql_real_escape_string($thumbPath));
            if ($this->Execute($sql)){
                return $this->getIdMax('images');
            } else {
                return FALSE;
            }
        }
    }
    
    function getImageData($id){
        $sql = "SELECT 
                    id, img_path, thumb_path
                FROM images
                WHERE id = ".$id;
        return $this->get1Row($sql);
    }
}

?>
