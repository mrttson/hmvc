<?php

require_once(APPPATH . 'controllers/CommonController.php');

class News extends CommonController {

    function __construct() {
        parent::__construct();
        //set default Layout
        $this->_layout = "admin"; //Normal layout
        $this->_contentData['moduleTitle'] = 'News';
        $this->load->Model('NewsModel');
    }

    function index($catId = NULL) {
        $this->_data['pageTitle'] = 'Danh Sách News';
        $this->_data['page'] = 'index';
        if (is_null($catId)) {
            $this->_contentData['listNews'] = $this->NewsModel->getListNews();
        } else {
            $this->_contentData['listNews'] = $this->NewsModel->getListNewsByCatId($catId);
        }
        $this->_contentData['listParentCat'] = $this->NewsModel->getListParentCat();
        $this->_data['content'] = $this->_contentData;
        $this->loadPage();
    }

    function category() {
        $this->_data['pageTitle'] = 'Danh Mục News';
        $this->_data['page'] = 'category';
        $this->_contentData['listCat'] = $this->NewsModel->getListCat();
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

    function getProductInfoById() {
        $req = $_POST['data'];
        if ($req['pId']) {
            $data = $this->ProductModel->getProductInfoById($req['pId']);
        }
        if ($data) {
            $data['error'] = '0';
            if (file_exists(PUBLIC_PATH . 'images/' . $data['image_path'])) {
                $data['image_path'] = base_url() . 'public/images/' . $data['image_path'];
            } else {
                $data['image_path'] = base_url() . 'public/images/default_img_thumb.gif';
            }
            echo json_encode($data);
        } else {
            echo json_encode(array('error' => '0'));
        }
    }

    function ajaxUpdate() {
        sleep(1);
        $req = $_POST['data'];
        if ($req['pId']) {
            $res = $this->ProductModel->update($req);
            if ($res) {
//                $this->session->set_flashdata('feedback', 'Success message for client to see');
//                echo $this->session->flashdata('feedback');
                echo json_encode(array('error' => '0'));
            } else {
                echo json_encode(array('error' => '1'));
            }
        } else {
            echo json_encode(array('error' => '0'));
        }
    }

    function ajaxUpdateImgProduct() {
        $imgInfo = $_FILES['image'];
        $uploadImgSuccess = $this->uploadImg($imgInfo);
        $data['pId'] = $_POST['pId'];
        if ($uploadImgSuccess && $uploadImgSuccess != NULL) {
            $data['image_path'] = $uploadImgSuccess;
            if ($this->ProductModel->updateImgProduct($data)) {
                echo json_encode(array('error' => '0'));
            } else {
                echo json_encode(array('error' => '1'));
            }
        } else if ($uploadImgSuccess == NULL) {
            echo json_encode(array('error' => '1'));
        }
    }

}

?>
