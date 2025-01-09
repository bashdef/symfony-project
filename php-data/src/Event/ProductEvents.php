<?php
namespace App\Event;

use App\Entity\Product;
use Symfony\Contracts\EventDispatcher\Event;

final class ProductEvents extends Event
{
    public const string CREATED = 'product.add';
    public const string DELETED = 'product.delete';

    private int $productId;

    public function __construct(int $id)
    {
        $this->productId = $id;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }
}