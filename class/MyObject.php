<?php
/**
 * Created by PhpStorm.
 * User: mikes
 * Date: 24/6/20
 * Time: 7:12 PM
 */

class MyObject
{
    private $_x;
    private $_y;
    private $_backgroundColor;
    private $_distanceFromOrigin;

    public function __construct($x,$y,$background)
    {
        $this->_x=$x;
        $this->_y=$y;
        $this->_backgroundColor=$background;
        $this->calcDistanceFromOrigin();

    }

    /**
     * @return mixed
     */
    public function getBackgroundColor()
    {
        return $this->_backgroundColor;
    }

    /**
     * @param mixed $backgroundColor
     */
    public function setBackgroundColor($backgroundColor)
    {
        $this->_backgroundColor = $backgroundColor;
    }



    /**
     * @return mixed
     */
    public function getX()
    {
        return $this->_x;
    }

    /**
     * @param mixed $x
     */
    public function setX($x)
    {
        $this->_x = $x;
    }

    /**
     * @return mixed
     */
    public function getY()
    {
        return $this->_y;
    }

    /**
     * @param mixed $y
     */
    public function setY($y)
    {
        $this->_y = $y;
    }

    public function calcDistanceFromOrigin(){
        $result=pow($this->_x,2)+pow($this->_y,2);
        $this->_distanceFromOrigin=sqrt($result);
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return '('.$this->_x.','.$this->_y.')'.'   color=<span style="background-color: '.$this->_backgroundColor.'">'.$this->_backgroundColor.'</span>  distance from origin='.$this->_distanceFromOrigin;

    }


}