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

    function index($catId = NULL) {
        $this->_data['pageTitle'] = 'Danh Sách Sản Phẩm';
        $this->_data['page'] = 'index';
        if (is_null($catId)) {
            $this->_contentData['listProduct'] = $this->ProductModel->getListProduct();
        } else {
            $this->_contentData['listProduct'] = $this->ProductModel->getListProductByCatId($catId);
        }
        $this->_contentData['listParentCat'] = $this->ProductModel->getListParentCat();
        $this->_data['content'] = $this->_contentData;
        $this->loadPage();
    }

    function ajaxGetProductInfoById() {
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
    
    /*
     * update product info by ajax
     * 
     * return product info
     */
    function ajaxUpdate() {
        sleep(1);
        $req = $_POST['data'];
        if ($req['pId'] > 0) {
            $res = $this->ProductModel->update($req);
            if ($res) {
                $pInfo = $this->ProductModel->getProductInfoById($res);
                if ($pInfo){
                    $pInfo['error'] = '0';
                    if (file_exists(PUBLIC_PATH . 'images/' . $pInfo['image_path'])) {
                        $pInfo['image_path'] = base_url() . 'public/images/' . $pInfo['image_path'];
                    } else {
                        $pInfo['image_path'] = base_url() . 'public/images/default_img_thumb.gif';
                    }
                    echo json_encode($pInfo);
                } else {
                    echo json_encode(array('error' => '1'));
                }
            } else {
                echo json_encode(array('error' => '1'));
            }
        } else {
            echo json_encode(array('error' => '0'));
        }
    }
    /*
     * Update image product by Ajax
     * 
     * return prodcuct info
     */
    function ajaxUpdateImgProduct() {
        sleep(1);
        $imgInfo = $_FILES['image'];
        $uploadImgSuccess = $this->uploadImg($imgInfo);
        $data['pId'] = $_POST['pId'];
        if ($uploadImgSuccess && $uploadImgSuccess != NULL) {
            $data['image_path'] = $uploadImgSuccess;
            $pid = $this->ProductModel->updateImgProduct($data);
            if ($pid > 0) {
                $pInfo = $this->ProductModel->getProductInfoById($pid);
                $pInfo['error'] = '0';
                if (file_exists(PUBLIC_PATH . 'images/' . $pInfo['image_path'])) {
                    $pInfo['image_path'] = base_url() . 'public/images/' . $data['image_path'];
                } else {
                    $pInfo['image_path'] = base_url() . 'public/images/default_img_thumb.gif';
                }
                echo json_encode($pInfo);
            } else {
                echo json_encode(array('error' => '1'));
            }
        } else if ($uploadImgSuccess == NULL) {
            echo json_encode(array('error' => '1'));
        }
    }

}

?>
