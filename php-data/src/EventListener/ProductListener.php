<?php
namespace App\EventListener;

use App\Service\Telegram;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use App\Event\ProductEvents;
use Doctrine\ORM\EntityManagerInterface;

#[AsEventListener(event: ProductEvents::CREATED, method: 'onAddProduct')]
#[AsEventListener(event: ProductEvents::DELETED, method: 'onDeleteProduct')]
class ProductListener
{
    private Telegram $telegram;
    private EntityManagerInterface $entityManager;

    public function __construct(Telegram $telegram, EntityManagerInterface $entityManager)
    {
        $this->telegram = $telegram;
        $this->entityManager = $entityManager;;
    }

    public function onAddProduct(ProductEvents $event): void
    {
        $productId = $event->getProductId();

        $this->telegram->send('Create product with id: ' . $productId);
    }

    public function onDeleteProduct(ProductEvents $event): void
    {
        $productId = $event->getProductId();

        $this->telegram->send('Delete product with id: ' . $productId);
    }
}