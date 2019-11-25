<?php

// src/Controller/WildController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class WildController extends AbstractController
{
    /**
     * @return Response
     * @Route("/wild", name="wild_index")
     */
    public function index() :Response
    {
        return $this->render('/wild/index.html.twig', [
            'website' => 'Wild Series',
            ]);
    }
}