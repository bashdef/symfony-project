<?php
namespace App\EventListener;

use App\Service\Telegram;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use App\Event\ProductEvents;

#[AsEventListener(event: ProductEvents::CREATED, method: 'onAddProduct')]
#[AsEventListener(event: ProductEvents::DELETED, method: 'onDeleteProduct')]
class ProductListener
{
    private Telegram $telegram;

    public function __construct(Telegram $telegram)
    {
        $this->telegram = $telegram;
    }

    public function onAddProduct(ProductEvents $event): void
    {
        $product = $event->getProduct();

        $this->telegram->send('Create product with id: ' . $product->getId());
    }

    public function onDeleteProduct(ProductEvents $event): void
    {
        $product = $event->getProduct();

        $this->telegram->send('Delete product with id: ' . $product->getId());
    }
}