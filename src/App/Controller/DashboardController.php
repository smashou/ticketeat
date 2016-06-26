<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends Controller
{
    /**
     * @Route("/dashboard", name="dashboard_homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('App:Dashboard:index.html.twig');
    }
}
