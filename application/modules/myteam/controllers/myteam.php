<?php

require_once(APPPATH . 'controllers/CommonController.php');

class Myteam extends CommonController {

    public function __construct() {
        parent::__construct();
        $this->_layout = 'admin';
        $this->load->Model('myteammodel');
        $this->_data['moduleTitle'] = 'Người Dùng';
    }

    function index($mName = NULL) {
        $this->_layout = NULL;
        $this->_data['pageTitle'] = 'Member Show';
        $this->_data['page'] = 'index';
        $this->_data['content'] = $this->_contentData;
        $this->loadPage();
    }

    function ajaxGetImg() {
        $req = $_POST['data'];
        $data['image'] = $this->myteammodel->getImg($req);
        if ($data) {
            $data['error'] = '0';
            foreach ($data['image'] as $key => $img) {
                if (file_exists(PUBLIC_PATH . 'images/' . $img['img_name'])) {
                    $data['image'][$key] = base_url() . 'public/images/' . $img['img_name'];
                } else {
                    $data['image'][$key] = base_url() . 'public/images/default_img_thumb.gif';
                }
            }
            echo json_encode($data);
        } else {
            echo json_encode(array('error' => '1'));
        }
    }

    function getTeamList() {
        $data = $this->myteammodel->getListMemberInfo();
        foreach ($data as $key => $rowData) {
            if (file_exists(PUBLIC_PATH . 'images/' . $rowData['avatar'])) {
                $data[$key]['avatar'] = base_url() . 'public/images/' . $rowData['avatar'];
            } else {
                $data[$key]['avatar'] = base_url() . 'public/images/default_img_thumb.gif';
            }
        }
        return $data;
    }

    function ajaxGetMemberInfo() {
        $req = $_POST['data'];
        $data = $this->myteammodel->getMemberInfoById($req['mid']);
        if ($data['info'] == FALSE || $data['album'] == FALSE) {
            $data['error'] = '1';
        } else {
            $data['error'] = '0';
            if (file_exists(PUBLIC_PATH . 'images/' . $data['info']['avatar'])) {
                $data['info']['avatar'] = base_url() . 'public/images/' . $data['info']['avatar'];
            } else {
                $data['info']['avatar'] = base_url() . 'public/images/default_img_thumb.gif';
            }
            foreach ($data['album'] as $key => $rowData) {
                if (file_exists(PUBLIC_PATH . 'images/' . $rowData['img_name'])) {
                    $data['album'][$key]['img_name'] = base_url() . 'public/images/' . $rowData['img_name'];
                } else {
                    $data['album'][$key]['img_name'] = base_url() . 'public/images/default_img_thumb.gif';
                }
            }
        }

        echo json_encode($data);
    }

    function ajaxUploadAlbum() {
        $albumInfo = $_FILES;
        $data['album'] = $this->uploadMultiImg($albumInfo);
        $data['mid'] = $_POST['mid'];
        if ($this->myteammodel->updateAlbum($data)) {
            $data['error'] = '0';
            foreach ($data['album'] as $key => $imgName) {
                if (file_exists(PUBLIC_PATH . 'images/' . $imgName)) {
                    $data['album'][$key] = base_url() . 'public/images/' . $imgName;
                } else {
                    $data['album'][$key] = base_url() . 'public/images/default_img_thumb.gif';
                }
            }
        } else {
            $data['error'] = '1';
        }
        echo json_encode($data);
    }

    function teamlist() {
        $this->_layout = 'admin';
        $this->_data['pageTitle'] = 'Member List';
        $this->_data['page'] = 'teamlist';
        $this->_data['listMemberInfo'] = $this->getTeamList();
        $this->_data['content'] = $this->_contentData;
        $this->loadPage();
    }

}

?>
