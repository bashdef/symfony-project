<?php
namespace App\Event;

use App\Entity\Product;
use Symfony\Contracts\EventDispatcher\Event;

final class ProductEvents extends Event
{
    public const CREATED = 'product.add';
    public const DELETED = 'product.delete';

    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }
}