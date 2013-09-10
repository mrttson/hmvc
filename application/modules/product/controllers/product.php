<?php

require_once(APPPATH . 'controllers/CommonController.php');

class Product extends CommonController {

    function __construct() {
        parent::__construct();
        //set default Layout
        $this->_layout = "admin"; //Normal layout
        $this->_contentData['moduleTitle'] = 'Products';
        $this->load->Model('ProductModel');
    }

    const user_permisson = 1;
    const admin_permisson = 1; //Lấy khi user login

    function category() {
        $this->_data['pageTitle'] = 'Danh Mục Sản Phẩm';
        $this->_data['page'] = 'category';
        $this->_contentData['listCat'] = $this->ProductModel->getListCat();
        $this->_data['content'] = $this->_contentData;
        $this->loadPage();
    }

    function addCat() {
        if (!isset($_POST) || empty($_POST)) {
            $this->_data['pageTitle'] = 'Add Cat';
            $this->_data['page'] = 'addCat';
            $this->_contentData['listParentCat'] = $this->ProductModel->getListParentCat();
            $this->_data['content'] = $this->_contentData;
            $this->loadPage();
        } else {
            $data['title'] = $_POST['title'];
            $data['parent_id'] = $_POST['parent_id'];
            $data['orderno'] = $_POST['orderno'];
            $data['alias'] = $_POST['alias'];
            if ($this->ProductModel->addCat($data)) {
                redirect(site_url('product/category'));
            } else {
                echo 'Error when addCat';
                //redirect('systemmenu');
            }
        }
    }
    function editCat($id = NULL) {
        if (!empty($id)) {
            if (!isset($_POST) || empty($_POST)) {
                $this->_data['pageTitle'] = 'Edit Category';
                $this->_data['page'] = 'editCat';
                $this->_contentData['catInfo'] = $this->ProductModel->getCatInfoById($id);
                $this->_contentData['listParentCat'] = $this->ProductModel->getListParentCat();
                $this->_data['content'] = $this->_contentData;
                $this->loadPage();
            } else {
                //update System Menu Info
                $data['title'] = $_POST['title'];
                $data['parent_id'] = $_POST['parent_id'];
                $data['orderno'] = $_POST['orderno'];
                $data['alias'] = $_POST['alias'];
                $data['id'] = $id;
                if ($this->ProductModel->updateCat($data)) {
                    redirect(site_url('product/category'));
                } else {
                    echo 'Die when Edit Systen Menu';
                }
            }
        } else {
            echo 'Empty Id [Edit Cat]';
        }
    }
    
    function deleteCat($id = NULL) {
        if (!empty($id)) {
            if ($this->ProductModel->deleteCat($id)) {
                redirect('product/category');
            } else {
                echo 'Error SQL [DELETE Cat]';
            }
        } else {
            echo 'Empty Id [delete Cat]';
        }
    }

}

?>
