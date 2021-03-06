<?php

require_once(APPPATH . 'models/CommonModel.php');

class NewsModel extends CommonModel {

    public function __construct() {
        parent::__construct();
    }

    function getListCat() {
        $sql = "SELECT 
                        n1.id, n1.`name`, n1.keywords, n1.description, 
                        n1.parent_id, n2.`name` as parent_name, n1.`status`       
                FROM 
                    news_category n1
                LEFT JOIN news_category n2 ON n1.parent_id = n2.id
                ORDER BY 
                    n1.parent_id ASC, n1.orderno ASC";
        $res = $this->getData($sql);
        if ($res) {
            return $res;
        } else {
            return FALSE;
        }
    }

    function getListParentCat() {
        $sql = "SELECT
                    id, title 
                FROM product_category 
                WHERE parent_id = '0'";
        $res = $this->getData($sql);
        if ($res) {
            return $res;
        } else {
            return FALSE;
        }
    }

    function getCatInfoById($id = NULL) {
        if (!empty($id)) {
            $sql = "SELECT 
                        p1.id, p1.title, p1.parent_id, p2.title as parent_title, p1.orderno, p1.alias
                    FROM product_category p1
                    LEFT JOIN product_category p2 ON p1.parent_id = p2.id
                    WHERE p1.id = '" . $id . "'";
            return $res = $this->get1Row($sql);
        } else {
            return FALSE;
        }
    }

    function addCat($data) {
        $sql = "INSERT INTO product_category(title, parent_id, orderno, alias)
                VALUES('" . $data['title'] . "', '" . $data['parent_id'] . "', '" . $data['orderno'] . "', '" . $data['alias'] . "')";
        if ($this->Execute($sql)) {
            return $this->getIdMax();
        } else {
            return FALSE;
        }
    }

    function updateCat($data) {
        $sql = "UPDATE product_category 
                SET 
                    title = '" . $data['title'] . "',
                    parent_id = '" . $data['parent_id'] . "',
                    orderno = '" . $data['orderno'] . "',
                    alias = '" . $data['alias'] . "'
                WHERE
                id = '" . $data['id'] . "'
                ";
        if ($this->Execute($sql)) {
            return $data['id'];
        } else {
            return FALSE;
        }
    }

    function deleteCat($id) {
        $sql = "DELETE FROM
                product_category
                WHERE
                id = '" . $id . "'";
        if ($this->Execute($sql)) {
            return $id;
        } else {
            return FALSE;
        }
    }

    function getListNews() {
        $sql = "SELECT 
                    n.id, n.title, n.alias, n.brief, n.content,
                    n.`status`, n.image_path, video_path,
                    n.category_id, nc.`name` as cat_name, n.keywords
                FROM news n
                LEFT JOIN news_category nc ON n.category_id = nc.id";
        $res = $this->getData($sql);
        if ($res) {
            return $res;
        } else {
            return FALSE;
        }
    }

    function getListProductByCatId($catId) {
        $sql = "SELECT p.id, p.`name`, p.`desc`, p.attrs, p.image_path, p.`status`, pc.title
                FROM product p
                LEFT JOIN product_category pc ON p.category_id = pc.id
                WHERE 
                    pc.id = '" . $catId . "'";
        $res = $this->getData($sql);
        if ($res) {
            return $res;
        } else {
            return FALSE;
        }
    }

    function getProductInfoById($id) {
        $sql = "SELECT 
                    p.id, p.`name`, p.`desc`, p.attrs, p.image_path, p.`status`, pc.title
                FROM product p
                LEFT JOIN product_category pc ON p.category_id = pc.id
                WHERE 
                    p.id = '" . $id . "'";
        $res = $this->get1Row($sql);
        if ($res) {
            return $res;
        } else {
            return FALSE;
        }
    }

    function update($data) {
        $sql = "UPDATE product 
                SET 
                    `name` = '" . $data['pName'] . "',
                    category_id = '" . $data['pCatId'] . "',
                    `status` = '" . $data['pStatus'] . "'
                WHERE
                    id='" . $data['pId'] . "'";
        if ($this->Execute($sql)) {
            return $data['pId'];
        } else {
            return FALSE;
        }
    }

    function updateImgProduct($data) {
        $sql = "UPDATE product 
                SET 
                    image_path = '" . $data['image_path'] . "'
                WHERE
                    id='" . $data['pId'] . "'";
        //var_dump($sql);die();
        if ($this->Execute($sql)) {
            return $data['pId'];
        } else {
            return FALSE;
        }
    }

}

?>
