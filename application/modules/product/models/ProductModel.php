<?php

require_once(APPPATH . 'models/CommonModel.php');

class ProductModel extends CommonModel {

    public function __construct() {
        parent::__construct();
    }

    /*
     * Get list product category
     * 
     * return Array
     */
    function getListCat() {
        $sql = "SELECT 
                    p1.id, p1.title, p1.parent_id, p2.title as parent_title, p1.orderno, p1.alias
                FROM 
                    product_category p1
                LEFT JOIN product_category p2 ON p1.parent_id = p2.id
                ORDER BY 
                    p1.parent_id ASC, p1.orderno ASC";
        $res = $this->getData($sql);
        if ($res) {
            return $res;
        } else {
            return FALSE;
        }
    }
    
    /*
     * Get list parent product category
     * 
     * return Array
     */
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

    /*
     * Get product category info by Id
     * param string id
     * 
     * return Array
     */
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
    
    /*
     * Add product category to DB
     * param Array data
     * 
     * return string id
     */
    function addCat($data) {
        $sql = "INSERT INTO product_category(title, parent_id, orderno, alias)
                VALUES('" . $data['title'] . "', '" . $data['parent_id'] . "', '" . $data['orderno'] . "', '" . $data['alias'] . "')";
        if ($this->Execute($sql)) {
            return $this->getIdMax('product_category');
        } else {
            return FALSE;
        }
    }

    /*
     * Edit product category
     * param Array data
     * 
     * return string id
     */
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

    /*
     * Delete product category
     * param string id
     * 
     * return string id
     */
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

    /*
     * Get list product
     * 
     * return Array
     */
    function getListProduct() {
        $sql = "SELECT 
                    p.id, p.`name`, p.`desc`, p.attrs, p.image_path, p.`status`, pc.title
                FROM product p
                LEFT JOIN product_category pc ON p.category_id = pc.id";
        $res = $this->getData($sql);
        if ($res) {
            return $res;
        } else {
            return FALSE;
        }
    }

    /*
     * Get list product belong to product category
     * param catId
     * 
     * return Array product
     */
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

    /*
     * Get product info by Id
     * param string Id
     * 
     * return Array productInfo
     */
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

    /*
     * Update product info
     * param Array data
     * 
     * return productId
     */
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

    /*
     * update image of product
     * param Array data
     * 
     * return productId
     */
    function updateImgProduct($data) {
        $sql = "UPDATE product 
                SET 
                    image_path = '" . $data['image_path'] . "'
                WHERE
                    id='" . $data['pId'] . "'";
        if ($this->Execute($sql)) {
            return $data['pId'];
        } else {
            return FALSE;
        }
    }

}

?>
