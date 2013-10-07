<?php

ob_start();
if (!isset($_SESSION)) {
    session_start();
}
require_once(APPPATH . 'controllers/CommonController.php');

class Caro extends CommonController {

    public function __construct() {
        parent::__construct();
        $this->_layout = 'admin';
        $this->load->Model('caromodel');
        $this->_data['moduleTitle'] = 'Caro';
    }

    function index($mName = NULL) {
        $this->_layout = NULL;
        $this->_data['pageTitle'] = 'Caro';
        $this->_data['page'] = 'index';
        $this->_contentData['listUserWait'] = $this->caromodel->getListUserWait();
        //var_dump($this->_contentData['listUserWait']);
        $this->_data['content'] = $this->_contentData;
        $this->loadPage();
    }

    function login() {
        echo json_encode(array('token' => md5(session_id())));
    }

    function createRequestDeal() {
        $req = $_POST['data'];
        if ($this->caromodel->addRequestDeal($req)) {
            echo json_encode(array('success' => '1'));
        } else {
            echo json_encode(array('success' => '0'));
        }
    }

    function createDeal() {
        $req = $_POST['data'];
        $idDealLog = $this->caromodel->addDeal($req);
        if ($idDealLog) {
            echo json_encode(array('success' => '1', 'idDealLog' => $idDealLog));
        } else {
            echo json_encode(array('success' => '0'));
        }
    }

    function process() {
        sleep(2);
        $req = $_POST;
        $arr = array('position' => '1,1');
        echo json_encode($arr);
    }

    function save() {
        echo json_encode(array('success' => '1'));
    }

    function wait() {
        $req = $_POST;
        if ($this->caromodel->addPlayerWait($req)) {
            echo json_encode(array('success' => '1'));
        } else {
            echo json_encode(array('success' => '0'));
        }
    }

    function waitDeal() {
        $token = $_POST['token'];
        $data = $this->checkRequestDeal($token);
        echo json_encode($data);
    }

    function checkRequestDeal($token) {
        $res = $this->caromodel->getRequestDealData($token);
        if (count($res) > 0) {
            return $res;
        } else {
            sleep(2);
            return $this->checkRequestDeal($token);
        }
    }

    function waittingPosition() {
        $req = $_POST['data'];
        $newPosition = $this->caromodel->getNewPosition($req);
    }

    function reloadPlayerWait() {
        $data = $this->caromodel->getListUserWait();
        var_dump('xxxxxxxxxxxxxxx' . $data);
        die();
        if ($data) {
            echo json_encode($data);
        } else {
            echo json_encode(array('error' => '1'));
        }
    }
    
    function sendPosition() {
        $req = $_POST;
        $data = $this->caromodel->addPositionLog($req);
        if ($data){
            echo json_encode(array('id' => $data, 'success' => '1'));
        } else {
            echo json_encode(array('success' => '0'));
        }
    }

}

?>
