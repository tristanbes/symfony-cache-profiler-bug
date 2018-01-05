<?php

namespace AppBundle\Controller;

use AppBundle\Manager\GlobalStatistics;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(GlobalStatistics $globalStatistics)
    {
        $stat = $globalStatistics->getStatistics();

        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    public function menuAction()
    {
        return $this->render('default/menu.html.twig', []);
    }
}
