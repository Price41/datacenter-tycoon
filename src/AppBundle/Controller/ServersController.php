<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Customer;
use AppBundle\Entity\Server;

class ServersController extends Controller
{
    /**
     * @Route("/servers", name="servers")
     */
    public function indexAction()
    {
        $user = $this->getUser();
        $session = $this->get('session');
        $session->set('user_id', $user->getId());
        $session->set('username', $user->getUsername());

        $em = $this->getDoctrine()->getManager();
        $datacenters = $em->getRepository('AppBundle:Datacenter')->findByPlayer($user);
        $typeServers = $em->getRepository('AppBundle:TypeServer')->findAll();

        return $this->render('servers/index.html.twig', array(
            'datacenters' => $datacenters,
            'type_servers' => $typeServers
        ));
    }

    /**
     * @Route("/servers/buy/{name}", name="servers_buy")
     */
    public function buyAction($name)
    {
        $user = $this->getUser();
        $session = $this->get('session');
        $session->set('user_id', $user->getId());
        $session->set('username', $user->getUsername());

        $em = $this->getDoctrine()->getManager();
        $datacenters = $em->getRepository('AppBundle:Datacenter')->findByPlayer($user);
        $typeServer = $em->getRepository('AppBundle:TypeServer')->findOneByName($name);


        // Check if player have enough money
        if($user->getBalance() >= $typeServer->getBuyingCost()) {


            // Check if there is enough empty space in a rack
            // TODO not yet implemented

            $rack = $datacenters[0]->getRacks()[0]; // get the 1st rack in the 1st datacenter

            $server = new Server();
            $server->setTypeServer($typeServer);
            $server->setUsageCpu(0);
            $server->setUsageRam(0);
            $server->setUsageHdd(0);
            $server->setUsageLan(0);
            $server->setUsageWan(0);
            $server->setRack($rack);
            $em->persist($server);

            $offers = $user->getOffers();
            $offer = null;
            foreach ($offers as $o) {
                if($o->getTypeServer() == $typeServer) {
                    $offer = $o;
                    break;
                }
            }

            $customer = new Customer();
            $customer->setOffer($offer);
            $customer->setName('John Doe');
            $customer->setQuantity(1);
            $customer->setSubscriptionDate(new \DateTime('now'));
            $em->persist($customer);

            $user->setBalance($user->getBalance() - $typeServer->getBuyingCost());
            $em->flush();

        }

        return $this->redirectToRoute('dashboard');
    }
}
