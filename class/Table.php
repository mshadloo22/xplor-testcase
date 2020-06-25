<?php
/**
 * Created by PhpStorm.
 * User: mikes
 * Date: 24/6/20
 * Time: 7:06 PM
 */

include_once 'MyObject.php';

class Table extends MyObject
{
    private $_width;
    private $_height;

    public function __construct($x, $y, $background,$width,$height)
    {
        parent::__construct($x, $y, $background);
        $this->_height=$height;
        $this->_width=$width;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->_width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width)
    {
        $this->_width = $width;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->_height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height)
    {
        $this->_height = $height;
    }



}