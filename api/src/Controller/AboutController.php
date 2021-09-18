<?php

declare(strict_types=1);

namespace App\Controller;

use App\ArgumentResolver\SpecificType;
use App\Service\SomeTest\EventDispatcher\CustomEvents\Order;
use App\Service\SomeTest\EventDispatcher\CustomEvents\OrderPlacedEvent;
use App\Service\SomeTest\SiteUpdate\MessageGenerator;
use App\Service\SomeTest\SiteUpdate\SiteUpdateManager;
use App\Service\SomeTest\Transformer\Rot13Transformer;
use App\Service\SomeTest\Transformer\TransformerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

#[Route('/about', name: 'about_')]
final class AboutController extends AbstractController
{
    private EventDispatcherInterface $dispatcher;


    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }


    #[Route('', name: 'index', methods: ['GET'])]
    public function index(
        MessageGenerator $generator,
        SiteUpdateManager $manager,
        TransformerInterface $transformer
    ): Response
    {
        $message = $generator->getHappyMessage();
        $manager->notifyOfSiteUpdate();

        if ($transformer instanceof Rot13Transformer) {
            $transformer->setLogger($generator->getLogger());
        }

        $transformer->transform($message);

        $this->dispatcher->dispatch(
            new OrderPlacedEvent(new Order()),
            OrderPlacedEvent::NAME
        );

        $number = 5;
        return $this->render('base.html.twig', [
            'number' => $number
        ]);
    }

    #[Route(
        '/{id}',
        name: 'show',
        requirements: ['id' => '\d+'],
        defaults: ['page' => 1, 'title' => 'Hello world!'],
        methods: ['GET'],
        priority: 2,
        locale: 'en',
        format: 'html',
    )]
    public function show(int $id, Request $request, UrlGeneratorInterface $route): Response
    {
        $allAttributes = $request->attributes->all();
        $url = $route->generate(
            'about_index',
            [],
            UrlGeneratorInterface::ABSOLUTE_URL
        );

        $this->addFlash(
            'notice',
            'Ваши изменения сохранены!'
        );
        // $this->addFlash() is equivalent to $request->getSession()->getFlashBag()->add()


        return $this->render('base.html.twig', [
            'number' => $id
        ]);
    }

    #[Route(
        '/type',
        name: 'specific_type',
        methods: ['GET'],
    )]
    public function specificType(SpecificType $type): Response
    {
        $email = $this->getParameter('app.admin_email');

        return $this->json(['type' => $type->getValue()]);
    }

}