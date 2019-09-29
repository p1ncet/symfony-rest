<?php

namespace App\Controller;

use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/", name="")
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/")
     * @return Response
     */
    public function getNothing(): Response
    {
        throw $this->createNotFoundException();
    }

    /**
     * @Route("/api")
     * @return View
     */
    public function getNone(): View
    {
        return View::create(["error" => "dig deeper"], Response::HTTP_I_AM_A_TEAPOT);
    }
}
