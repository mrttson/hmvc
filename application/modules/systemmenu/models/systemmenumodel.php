<?php

require_once(APPPATH . 'models/commonmodel.php');

class SystemmenuModel extends CommonModel {

    public function __construct() {
        parent::__construct();
    }

    function getSystemMenuInfoById($id = NULL) {
        if (!empty($id)) {
            $sql = "SELECT 
                        s1.id, s1.title, s1.url, s1.parent_id, s2.title as parent_title, s1.orderno, s1.icon_path, s1.`status`
                    FROM systemmenu s1
                    LEFT JOIN systemmenu s2 ON s1.parent_id = s2.id
                    WHERE s1.id = '" . $id . "'";
            return $res = $this->get1Row($sql);
        } else {
            return FALSE;
        }
    }


    function getListParentMenu() {
        $sql = "SELECT
                    id, title 
                FROM systemmenu 
                WHERE parent_id = '0'";
        $res = $this->getData($sql);
        if ($res) {
            return $res;
        } else {
            return FALSE;
        }
    }

    function add($data) {
        $sql = "INSERT INTO systemmenu(title, url, parent_id, orderno, icon_path, status)
                VALUES('" . $data['title'] . "', '" . $data['url'] . "', '" . $data['parent_id'] . "', '" . $data['orderno'] . "', '" . $data['icon_path'] . "', '" . $data['status'] . "')";
        if ($this->Execute($sql)) {
            return $this->getIdMax('systemmenu');
        } else {
            return FALSE;
        }
    }

    function getListSystemMenu($start, $limit) {
        $sql = "SELECT 
                    s1.id, s1.title, s1.url, s1.parent_id, s2.title as parent_title, s1.orderno, s1.icon_path, s1.`status`
                FROM 
                    systemmenu s1
                LEFT JOIN systemmenu s2 ON s1.parent_id = s2.id
                ORDER BY 
                    s1.parent_id ASC, s1.orderno ASC
                LIMIT ". $start .",". $limit;
        $res = $this->getData($sql);
        if ($res) {
            return $res;
        } else {
            return FALSE;
        }
    }
    
    function getCountAll() {
        return $this->db->count_all('systemmenu');
    }

    function update($data) {
        $sql = "UPDATE systemmenu 
                SET 
                    title = '" . $data['title'] . "',
                    url = '" . $data['url'] . "',
                    parent_id = '" . $data['parent_id'] . "',
                    orderno = '" . $data['orderno'] . "',";
        if ($data['icon_path'] != '') {
            $sql .= "icon_path = '" . $data['icon_path'] . "',";
        } else {
            $sql .= "icon_path = NULL,";
        }
        $sql .= "`status` = '" . $data['status'] . "'
                WHERE
                id = '" . $data['id'] . "'
                ";
        if ($this->Execute($sql)) {
            return $data['id'];
        } else {
            return FALSE;
        }
    }

    function delete($id) {
        $sql = "DELETE FROM
                systemmenu
                WHERE
                id = '" . $id . "'";
        if ($this->Execute($sql)) {
            return $id;
        } else {
            return FALSE;
        }
    }

}

?>
