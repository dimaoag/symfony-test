<?php

declare(strict_types=1);

namespace App\Service\SomeTest\EventDispatcher\CustomEvents;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class StoreSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::RESPONSE => [
                ['onKernelResponsePre', 10],
                ['onKernelResponsePost', -10],
            ],
            OrderPlacedEvent::NAME => 'onStoreOrder',
        ];
    }


    public function onKernelResponsePre(ResponseEvent $event): void
    {
        // ...
    }

    public function onKernelResponsePost(ResponseEvent $event): void
    {
        // ...
    }

    public function onStoreOrder(OrderPlacedEvent $event, string $eventName, EventDispatcherInterface $dispatcher): void
    {
        // ...
    }
}