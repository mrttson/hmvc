<?php

class CommonModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
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
    
    /*
     * Get User Info Data Function
     */
    function getUserInfoData(){
        
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
        $res = $this->getData('select * from config');
        return $res[0];
    }

}

?>
