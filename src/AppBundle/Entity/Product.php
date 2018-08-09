<?php
/**
 * Created by PhpStorm.
 * User: ncourtois
 * Date: 09/08/2018
 * Time: 13:56
 */

namespace AppBundle\Entity;


use phpDocumentor\Reflection\Types\Self_;

class Product
{
    const FOOD_PRODUCT = 'food';

    private $name;

    private $type;

    private $price;

    public function __construct($name, $type, $price)
    {
        $this->name = $name;
        $this->type = $type;
        $this->price = $price;
    }

    public function computeTVA()
    {
        if ($this->price < 0) {
            throw new \LogicException('The TVA cannot be negative');
        }

        if (self::FOOD_PRODUCT == $this->type) {
            return $this->price * 0.055;
        }

        return $this->price * 0.196;
    }
}