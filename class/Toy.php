<?php
/**
 * Created by PhpStorm.
 * User: mikes
 * Date: 24/6/20
 * Time: 7:05 PM
 */
include_once 'MyObject.php';

class Toy extends MyObject
{
    private $_radious;
    private $_facing;

    private $_facingArray=[
        'N'=>'North',
        'E'=>'East',
        'W'=>'West',
        'S'=>'South'
    ];

    public function __construct($x, $y, $background,$radious,$facing)
    {
        parent::__construct($x, $y, $background);
        $this->_radious=$radious;
        $this->_facing=$facing;
    }

    /**
     * @return mixed
     */
    public function getFacing()
    {
        return $this->_facing;
    }

    /**
     * @param mixed $facing
     */
    public function setFacing($facing)
    {
        $this->_facing = $facing;
    }




    /**
     * @return mixed
     */
    public function getRadious()
    {
        return $this->_radious;
    }

    /**
     * @param mixed $radious
     */
    public function setRadious($radious)
    {
        $this->_radious = $radious;
    }

    public function move($forward=true){//if something goes wrong it needs to move backward
        switch($this->_facing){

            case 'N':
            $this->setY($this->getY()+($forward?1:-1));
                break;
            case 'S':
                $this->setY($this->getY()+($forward?-1:1));
                break;
            case 'E':
                $this->setX($this->getX()+($forward?1:-1));
                break;
            case 'W':
                $this->setX($this->getX()+($forward?-1:1));
                break;


        }
    }
    public function turn($direction='right'){//if something goes wrong it needs to move backward
        switch($this->_facing){
            case 'N':
                $this->setFacing($direction==='right'?'E':'W');
                break;
            case 'S':
                $this->setFacing($direction==='right'?'W':'E');
                break;
            case 'E':
                $this->setFacing($direction==='right'?'S':'N');
                break;
            case 'W':
                $this->setFacing($direction==='right'?'N':'S');
                break;


        }
    }



    public function __toString()
    {
        return parent::__toString().' | facing='.$this->_facing; // TODO: Change the autogenerated stub
    }

    public function _toResult(){
        return ' ('.$this->getX().','.$this->getY().')'.'  | '.$this->_facingArray[$this->getFacing()];
    }


}