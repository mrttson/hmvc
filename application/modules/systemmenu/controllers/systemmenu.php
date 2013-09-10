<?php

require_once(APPPATH . 'controllers/CommonController.php');

class Systemmenu extends CommonController {

    public function __construct() {
        parent::__construct();
        $this->_contentData['moduleTitle'] = 'System Menu';
        $this->_layout = 'admin';
        $this->load->Model('SystemmenuModel');
    }

    function index() {
        $this->_data['pageTitle'] = 'System Menu';
        $this->_data['page'] = 'index';
        $this->_contentData['listMenu'] = $this->SystemmenuModel->getListSystemMenu();
        $this->_data['content'] = $this->_contentData;
        $this->loadPage();
    }

    function add() {
        if (!isset($_POST) || empty($_POST)) {
            $this->_data['pageTitle'] = 'Add Menu';
            $this->_data['page'] = 'add';
            $this->_contentData['listParentMenu'] = $this->SystemmenuModel->getListParentMenu();
            $this->_data['content'] = $this->_contentData;
            $this->loadPage();
        } else {
            $data['title'] = $_POST['title'];
            $data['url'] = $_POST['url'];
            $data['parent_id'] = $_POST['parent_id'];
            $data['orderno'] = $_POST['orderno'];
            $data['status'] = $_POST['status'];
            $uploadFileInfo = $_FILES['icon_path'];
            $uploadImgSuccess = $this->uploadImg($uploadFileInfo);
            if ($uploadImgSuccess) {
                $data['icon_path'] = $uploadImgSuccess;
                if ($this->SystemmenuModel->add($data)) {
                    redirect(site_url('systemmenu'));
                } else {
                    echo 'Error when add systemmenu';
                    sleep(5);
                    redirect('systemmenu');
                }
            } else {
                echo 'Error when add UploadImg[Add systemmenu]';
                sleep(5);
                redirect('systemmenu');
            }
        }
    }

    function edit($id = NULL) {
        if (!empty($id)) {
            if (!isset($_POST) || empty($_POST)) {
                $this->_data['pageTitle'] = 'Edit System Menu';
                $this->_data['page'] = 'edit';
                $this->_contentData['systemMenuInfo'] = $this->SystemmenuModel->getSystemMenuInfoById($id);
                $this->_contentData['listParentMenu'] = $this->SystemmenuModel->getListParentMenu();
                $this->_data['content'] = $this->_contentData;
                $this->loadPage();
            } else {
                //update System Menu Info
                $data['title'] = $_POST['title'];
                $data['url'] = $_POST['url'];
                $data['parent_id'] = $_POST['parent_id'];
                $data['orderno'] = $_POST['orderno'];
                $data['status'] = $_POST['status'];
                $data['id'] = $id;
                $uploadFileInfo = $_FILES['icon_path'];
                $uploadImgSuccess = $this->uploadImg($uploadFileInfo);
                if ($uploadImgSuccess && $uploadImgSuccess != NULL) {
                    $data['icon_path'] = $uploadImgSuccess;
                } else if ($uploadImgSuccess == NULL){
                    $data['icon_path'] = '';
                }
                if ($this->SystemmenuModel->update($data)) {
                    redirect(site_url('systemmenu'));
                } else {
                    echo 'Die when Edit Systen Menu';
                    sleep(5);
                    redirect('systemmenu');
                }
            }
        } else {
            echo 'Empty Id [Edit Systemmenu]';
        }
    }

    function delete($id = NULL) {
        if (!empty($id)) {
            if ($this->SystemmenuModel->delete($id)) {
                redirect('systemmenu');
            } else {
                echo 'Error SQL [DELETE systemmenu]';
            }
        } else {
            echo 'Empty Id [delete systemmenu]';
        }
    }

}

?>
