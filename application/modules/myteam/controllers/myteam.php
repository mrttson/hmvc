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
        $this->_contentData['listMember'] = $this->myteammodel->getListMemberInfo();
        $this->_data['content'] = $this->_contentData;
        $this->loadPage();
    }

    function ajaxGetImg() {
        sleep(1);
        $req = $_POST['data'];
        $data['image'] = $this->myteammodel->getImg($req);
        if ($data) {
            $data['error'] = '0';
            foreach ($data['image'] as $key => $img) {
                if (file_exists($img['thumb_path'])) {
                    $data['image'][$key]['thumb_path'] = base_url() . $img['thumb_path'];
                } else {
                    $data['image'][$key]['thumb_path'] = base_url() . 'public/images/default_img_thumb.gif';
                }
                if (file_exists($img['img_path'])) {
                    $data['image'][$key]['img_path'] = base_url() . $img['img_path'];
                } else {
                    $data['image'][$key]['img_path'] = base_url() . 'public/images/default_img_thumb.gif';
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
            if (file_exists($rowData['avatar'])) {
                $data[$key]['avatar'] = base_url() . $rowData['avatar'];
            } else {
                $data[$key]['avatar'] = base_url() . 'public/images/default_img_thumb.gif';
            }
        }
        return $data;
    }

    function ajaxGetMemberInfo() {
        $req = $_POST['data'];
        $data = $this->myteammodel->getMemberInfoById($req['mid']);
        if ($data['info'] == FALSE) {
            $data['error'] = '1';
        } else {
            $data['error'] = '0';
            if (file_exists($data['info']['avatar'])) {
                $data['info']['avatar'] = base_url() . $data['info']['avatar'];
            } else {
                $data['info']['avatar'] = base_url() . 'public/images/default_img_thumb.gif';
            }
            //var_dump($data);die();
            foreach ($data['album'] as $key => $rowData) {
                if (file_exists($rowData['img_path'])) {
                    $data['album'][$key]['img_path'] = base_url() . $rowData['img_path'];
                } else {
                    $data['album'][$key]['img_path'] = base_url() . 'public/images/default_img_thumb.gif';
                }
                if (file_exists($rowData['thumb_path'])) {
                    $data['album'][$key]['thumb_path'] = base_url() . $rowData['thumb_path'];
                } else {
                    $data['album'][$key]['thumb_path'] = base_url() . 'public/images/default_img_thumb.gif';
                }
            }
        }

        echo json_encode($data);
    }

    function ajaxUploadAlbum() {
        $albumInfo = $_FILES;
        $data['album'] = $this->uploadMultiImg($albumInfo);
        //var_dump($data);die();
        $data['mid'] = $_POST['mid'];
        if ($this->myteammodel->updateAlbum($data)) {
            $data['error'] = '0';
            foreach ($data['album'] as $key => $imgId) {
                $imgInfo = $this->getImageInfo($imgId);
                if ($imgInfo) {
                    if (file_exists($imgInfo['thumb_path'])) {
                        $data['album'][$key] = base_url() . $imgInfo['thumb_path'];
                    } else {
                        $data['album'][$key] = base_url() . 'public/images/default_img_thumb.gif';
                    }
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
