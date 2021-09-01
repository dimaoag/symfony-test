<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    public function show(int $id, Request $request): Response
    {
        $allAttributes = $request->attributes->all();


        return $this->render('base.html.twig', [
            'number' => $id
        ]);
    }

}