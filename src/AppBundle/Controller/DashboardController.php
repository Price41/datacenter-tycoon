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
    public function indexAction()
    {
        $user = $this->getUser();
        $session = $this->get('session');
        $session->set('user_id', $user->getId());
        $session->set('username', $user->getUsername());

        $em = $this->getDoctrine()->getManager();
        $datacenters = $em->getRepository('AppBundle:Datacenter')->findByPlayer($user);

        return $this->render('dashboard/index.html.twig', array(
            'datacenters' => $datacenters,
            'ws_server_ip' => $this->getParameter('ws_server_ip'),
            'ws_server_port' => $this->getParameter('ws_server_port')
        ));
    }
}
