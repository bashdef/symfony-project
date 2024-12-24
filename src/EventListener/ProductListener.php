<?php
namespace App\EventListener;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\ORM\Event\PreRemoveEventArgs;
use App\Service\Telegram;
use Doctrine\Persistence\Event\LifecycleEventArgs;

#[AsEntityListener(event: 'preRemove', method: 'onPreRemove', entity: Product::class)]
#[AsEntityListener(event: 'postPersist', method: 'onPostPersist', entity: Product::class)]
class ProductListener
{
    private Telegram $telegram;

    public function __construct(Telegram $telegram)
    {
        $this->telegram = $telegram;
    }

    public function onPreRemove(Product $product, PreRemoveEventArgs $event): void
    {
        $this->telegram->send('Deleted product: ' . $product->getId());
    }

    public function onPostPersist(Product $product, PostPersistEventArgs $eventArgs): void
    {
        $this->telegram->send('New product: ' . $product->getId());
    }
}