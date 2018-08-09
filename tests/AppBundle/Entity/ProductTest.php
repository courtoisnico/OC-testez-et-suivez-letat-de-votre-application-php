<?php
/**
 * Created by PhpStorm.
 * User: ncourtois
 * Date: 09/08/2018
 * Time: 14:02
 */

namespace Tests\AppBundle\Entity;


use AppBundle\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    /**
     * @dataProvider pricesForFoodProduct
     */
    public function testComputeTVAFoodProduct($price, $expectedTVA)
    {
        $product = new Product('Un produit', Product::FOOD_PRODUCT, $price);

        $this->assertSame($expectedTVA, $product->computeTVA());
    }

    public function pricesForFoodProduct()
    {
        return [
            [0, 0.0],
            [20, 1.1],
            [100, 5.5],
        ];
    }

    public function testComputeTVAOtherProduct()
    {
        $product = new Product('Un autre produit', 'Un autre type de produit', 20);

        $this->assertSame(3.92, $product->computeTVA());
    }

    public function testNegativePriceComputeTVA()
    {
        $product = new Product('Un produit', Product::FOOD_PRODUCT, -20);

        $this->expectException('LogicException');

        $product->computeTVA();
    }
}