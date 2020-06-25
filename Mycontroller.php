<?php
/**
 * Created by PhpStorm.
 * User: mikes
 * Date: 25/6/20
 * Time: 12:00 AM
 */

require_once './class/Table.php';
require_once './class/Toy.php';

class Mycontroller
{
    private $_getParams;

    public function __construct($getpar)
    {
        $this->_getParams = $getpar;
        session_start();

        //$_SESSION['object'] = serialize($this);
        //$object = unserialize($_SESSION['object']);

    }


    public function objPlace()
    {
        $request = $_POST;

        $tableoObj = new Table(0, 0, 'yellow', 5, 5);
        $toyObj = new Toy($request['x_co'], $request['y_co'], 'blue', 0.3, $request['facing']);

        $result = $toyObj->_toResult();
        $status = true;
        if ($this->_isToyOutofTable($toyObj, $tableoObj)) {
            $feedback = 'Toy is out of table';
            $toyObj = null;
            $status = false;
        } else {
            $feedback = $toyObj->_toResult();
        }
        $_SESSION['tableObj'] = serialize($tableoObj);
        $_SESSION['toyObj'] = serialize($toyObj);

        header('Content-type: application/json');
        echo json_encode(['feedback' => $feedback, 'status' => $status]);


    }

    public function objMove()
    {
        if(!isset($_SESSION['toyObj'])){
            header('Content-type: application/json');
            echo json_encode(['feedback' => 'There is no toy', 'status' => false]);
            return;

        }
        /** @var Toy $toyObj */
        $toyObj = unserialize($_SESSION['toyObj']);
        /** @var Table $tableObj */
        $tableObj = unserialize($_SESSION['tableObj']);
        if($toyObj==null){
            header('Content-type: application/json');
            echo json_encode(['feedback' => 'There is no toy set on table', 'status' => false]);
            return;
        }
        $toyObj->move();
        $status = true;
        if ($this->_isToyOutofTable($toyObj, $tableObj)) {
            $toyObj->move(false);
            $status = false;

        }

        $_SESSION['tableObj'] = serialize($tableObj);
        $_SESSION['toyObj'] = serialize($toyObj);
        header('Content-type: application/json');
        echo json_encode(['feedback' => $toyObj->_toResult(), 'status' => $status]);


    }

    public function objRight()
    {
        if(!isset($_SESSION['toyObj'])){
            header('Content-type: application/json');
            echo json_encode(['feedback' => 'There is no toy', 'status' => false]);
            return;

        }
        /** @var Toy $toyObj */
        $toyObj = unserialize($_SESSION['toyObj']);
        /** @var Table $tableObj */
        $tableObj = unserialize($_SESSION['tableObj']);
        if($toyObj==null){
            header('Content-type: application/json');
            echo json_encode(['feedback' => 'There is no toy set on table', 'status' => false]);
            return;
        }
        $toyObj->turn();
        $status = true;

        $_SESSION['tableObj'] = serialize($tableObj);
        $_SESSION['toyObj'] = serialize($toyObj);
        header('Content-type: application/json');
        echo json_encode(['feedback' => $toyObj->_toResult(), 'status' => $status]);


    }

    public function objLeft()
    {
        if(!isset($_SESSION['toyObj'])){
            header('Content-type: application/json');
            echo json_encode(['feedback' => 'There is no toy', 'status' => false]);
            return;

        }
        /** @var Toy $toyObj */
        $toyObj = unserialize($_SESSION['toyObj']);
        /** @var Table $tableObj */
        $tableObj = unserialize($_SESSION['tableObj']);
        if($toyObj==null){
            header('Content-type: application/json');
            echo json_encode(['feedback' => 'There is no toy set on table', 'status' => false]);
            return;
        }
        $toyObj->turn('left');
        $status = true;

        $_SESSION['tableObj'] = serialize($tableObj);
        $_SESSION['toyObj'] = serialize($toyObj);
        header('Content-type: application/json');
        echo json_encode(['feedback' => $toyObj->_toResult(), 'status' => $status]);


    }


    public function objReport()
    {
        if(!isset($_SESSION['toyObj']) ){
            header('Content-type: application/json');
            echo json_encode(['report' => 'There is no toy', 'status' => false]);
            return;

        }
        /** @var Toy $toyObj */
        $toyObj = unserialize($_SESSION['toyObj']);
        /** @var Table $tableObj */
        $tableObj = unserialize($_SESSION['tableObj']);
        if($toyObj==null){
            header('Content-type: application/json');
            echo json_encode(['report' => 'There is no toy set on table', 'status' => false]);
            return;
        }
        $isToyOutofTable = $this->_isToyOutofTable($toyObj, $tableObj);

        header('Content-type: application/json');
        echo json_encode(['report' => $toyObj->_toResult(), 'isToyOutofTable' => $isToyOutofTable]);
        //return json_encode();

    }
    public function resetObject(){
        /** @var Toy $toyObj */
        $toyObj = unserialize($_SESSION['toyObj']);
        /** @var Table $tableObj */
        $tableObj = unserialize($_SESSION['tableObj']);
        $status=true;


        header('Content-type: application/json');
        echo json_encode(['feedback' => $toyObj->_toResult(), 'status' => $status]);


    }

    private function _isToyOutofTable($toyObj, $tableObj)
    {

        return $toyObj->getX() > $tableObj->getWidth() || $toyObj->getX() < 0 || $toyObj->getY() > $tableObj->getHeight() || $toyObj->getY() < 0;
    }


}


//-----------------simple router
$func = isset($_GET['func']) ? $_GET['func'] : '';
$getp = $_GET;

if (trim($func) != '') {

    $method_name = $func;
    $ct = new Mycontroller($_GET);

    $ct->{$method_name}();


}