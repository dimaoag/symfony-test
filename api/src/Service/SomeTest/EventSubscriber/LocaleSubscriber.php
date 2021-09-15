<?php

declare(strict_types=1);

namespace App\Service\SomeTest\EventSubscriber;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class LocaleSubscriber implements EventSubscriberInterface
{
    private ?string $defaultLocale;

    public function __construct(?string $defaultLocale = 'en')
    {
        $this->defaultLocale = $defaultLocale;
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();

        if (!$request->hasPreviousSession()) {
            return;
        }

        // попробуйте увидеть, была ли локаль установлена как параметр маршрутизации _locale
        if ($locale = $request->attributes->get('_locale')) {
            $request->getSession()->set('_locale', $locale);
        } else {
            // если для этого запроса не было ясно установлено никакой локали, используйте её из сесии
            $request->setLocale($request->getSession()->get('_locale', $this->defaultLocale));
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            // должен быть зарегистрирован после слушателя локали по умолчанию
            KernelEvents::REQUEST => [['onKernelRequest', 15]],
        ];
    }
}