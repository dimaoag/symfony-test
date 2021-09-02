<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

#[Route('/about', name: 'about_')]
final class AboutController extends AbstractController
{
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
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

}