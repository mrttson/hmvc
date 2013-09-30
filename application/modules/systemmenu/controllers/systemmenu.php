<?php

require_once(APPPATH . 'controllers/CommonController.php');

class Systemmenu extends CommonController {

    public function __construct() {
        parent::__construct();
        $this->_contentData['moduleTitle'] = 'System Menu';
        $this->_layout = 'admin';
        $this->load->Model('systemmenumodel');
    }

    function index() {
        //Layout
        $this->_data['pageTitle'] = 'System Menu';
        $this->_data['page'] = 'index';
        
        //Pagination
        $this->_paginationConfig["base_url"] = base_url() . "systemmenu";
        $this->_paginationConfig["total_rows"] = $this->systemmenumodel->getCountAll();
        $this->pagination->initialize($this->_paginationConfig);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 1;
        $this->_contentData["links"] = $this->pagination->create_links();
        $start = ($page-1)*$this->_paginationConfig["per_page"];
        $limit = $this->_paginationConfig["per_page"];
        
        //Data
        $this->_contentData['listMenu'] = $this->systemmenumodel->getListSystemMenu($start, $limit);
        $this->_contentData['listParentMenu'] = $this->systemmenumodel->getListParentMenu();
        $this->_data['content'] = $this->_contentData;
        $this->loadPage();
    }

    function add() {
        if (!isset($_POST) || empty($_POST)) {
            $this->_data['pageTitle'] = 'Add Menu';
            $this->_data['page'] = 'add';
            $this->_contentData['listParentMenu'] = $this->systemmenumodel->getListParentMenu();
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
                if ($this->systemmenumodel->add($data)) {
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
                $this->_contentData['systemMenuInfo'] = $this->systemmenumodel->getSystemMenuInfoById($id);
                $this->_contentData['listParentMenu'] = $this->systemmenumodel->getListParentMenu();
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
                if ($this->systemmenumodel->update($data)) {
                    redirect(site_url('systemmenu'));
                } else {
                    //echo 'Die when Edit Systen Menu';
                    redirect('systemmenu');
                }
            }
        } else {
            echo 'Empty Id [Edit Systemmenu]';
        }
    }

    function delete($id = NULL) {
        if (!empty($id)) {
            if ($this->systemmenumodel->delete($id)) {
                redirect('systemmenu');
            } else {
                echo 'Error SQL [DELETE systemmenu]';
            }
        } else {
            echo 'Empty Id [delete systemmenu]';
        }
    }

    function ajaxGetSystemmenuInfoById(){
        $req = $_POST['data'];
        if ($req['sid']) {
            $data = $this->systemmenumodel->getSystemMenuInfoById($req['sid']);
        }
        if ($data) {
            $data['error'] = '0';
            if (file_exists(PUBLIC_PATH . 'images/' . $data['icon_path'])) {
                $data['icon_path'] = base_url() . 'public/images/' . $data['icon_path'];
            } else {
                $data['icon_path'] = base_url() . 'public/images/default_img_thumb.gif';
            }
            echo json_encode($data);
        } else {
            echo json_encode(array('error' => '0'));
        }
    }
}

?>
