<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
    	$authorization_checker = $this->get('security.authorization_checker');

		if (false === $authorization_checker->isGranted('ROLE_ADMIN') && 
            false === $authorization_checker->isGranted('ROLE_USER')) {
			return $this->render('App:Home:index.html.twig');
		}
        // replace this example code with whatever you need
        return $this->render('App:Dashboard:index.html.twig');
    }
}
