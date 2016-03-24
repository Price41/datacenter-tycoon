<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends Controller
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function displayAction()
    {
        $user = $this->getUser()->getUsername();
        $session = $this->get('session');
        $session->set('username', $user);

        return $this->render('dashboard/index.html.twig', array('user' => $user));
    }
}
