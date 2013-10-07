<?php

require_once(APPPATH . 'models/commonmodel.php');

class CaroModel extends CommonModel {

    public function __construct() {
        parent::__construct();
    }

    function getRequestDealData($token) {
        $sql = "SELECT 
                    id, requestToken
                FROM requestdeal
                WHERE recivedToken = '" . $token . "'";
        $data = $this->get1Row($sql);
        if ($data) {
            return $data;
        }
    }

    function addRequestDeal($param) {
        $sql = "INSERT INTO requestDeal(requestToken, recivedToken)
                VALUES('" . $param['requestToken'] . "', '" . $param['recivedToken'] . "')";
        var_dump($sql);die();
        if ($this->Execute($sql)) {
            return $this->getIdMax('requestDeal');
        } else {
            return FALSE;
        }
    }

    function addDeal($param) {
        $sqlacceptDeal = "UPDATE requestdeal SET result = 1 WHERE id = '" . $param['dealID'] . "'";
        if ($this->Execute($sqlacceptDeal)) {
            $sql = "INSERT INTO deallog(deallog.requestToken, deallog.acceptToken)
                SELECT requestdeal.requestToken, requestdeal.recivedToken
                FROM requestdeal
                WHERE requestdeal.id = '" . $param['dealID'] . "';";
            if ($this->Execute($sql)) {
                return $this->getIdMax('deallog');
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    function getNewPosition($param) {
        
    }

    function getListUserWait() {
        $sql = "SELECT id, `name`, token
                FROM playerwait";
        $data = $this->getData($sql);
        if ($data) {
            return $data;
        } else {
            return FALSE;
        }
    }

    function addPlayerWait($param) {
        $sql = "INSERT INTO playerwait(name,token)
                VALUES('" . $param['username'] . "', '" . $param['token'] . "')";
        if ($this->Execute($sql)) {
            return $this->getIdMax('playerwait');
        } else {
            return FALSE;
        }
    }

    function addPositionLog($param) {
        $sql = "INSERT INTO playlog(dealLogId, p_r, p_c)
                VALUES('" . $param['dealID'] . "', '" . $param['p_r'] . "', '" . $param['p_c'] . "')";
        if ($this->Execute($sql)){
            return $this->getIdMax('playlog');
        } else {
            return FALSE;
        }
    }

}

?>
