<?php

require_once(APPPATH . 'models/CommonModel.php');

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

    function getIdMax() {
        $sql = "SELECT 
                    MAX(id) AS maxid 
                FROM systemmenu";
        $res = $this->get1Cell($sql);
        return $res;
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
            return $this->getIdMax();
        } else {
            return FALSE;
        }
    }

    function getListSystemMenu() {
        $sql = "SELECT 
                    s1.id, s1.title, s1.url, s1.parent_id, s2.title as parent_title, s1.orderno, s1.icon_path, s1.`status`
                FROM 
                    systemmenu s1
                LEFT JOIN systemmenu s2 ON s1.parent_id = s2.id
                ORDER BY 
                    s1.parent_id ASC, s1.orderno ASC";
        $res = $this->getData($sql);
        if ($res) {
            return $res;
        } else {
            return FALSE;
        }
    }

    function update($data){
        var_dump($data);
        $sql = "UPDATE systemmenu 
                SET 
                    title = '".$data['title']."',
                    url = '".$data['url']."',
                    parent_id = '".$data['parent_id']."',
                    orderno = '".$data['orderno']."',
                    icon_path = '".$data['icon_path']."',
                    `status` = '".$data['status']."'
                WHERE
                    id = '".$data['id']."'
                    ";
        var_dump($sql);
        if($this->Execute($sql)){
            return $data['id'];
        } else {
            return FALSE;
        }
    }
    
    function delete($id){
        $sql = "DELETE FROM 
                        systemmenu
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
