<?php

namespace AppBundle\Controller;

use AppBundle\Form\UserType;
use AppBundle\Entity\User;
use AppBundle\Entity\Datacenter;
use AppBundle\Entity\Rack;
use AppBundle\Entity\Server;
use AppBundle\Entity\Offer;
use AppBundle\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'security/login.html.twig',
            array(
                'last_username' => $lastUsername,
                'error'         => $error,
            )
        );
    }

    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $user->setBalance(1000);
            $user->setResearchRank(0);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);

            $datacenter = new Datacenter();
            $datacenter->setPlayer($user);
            $typeDatacenter = $em->getRepository('AppBundle:TypeDatacenter')->findOneByName('Garage');
            $datacenter->setTypeDatacenter($typeDatacenter);
            $typeElectricity = $em->getRepository('AppBundle:TypeElectricity')->findOneByPower(7500);
            $datacenter->setTypeElectricity($typeElectricity);
            $typeInternet = $em->getRepository('AppBundle:TypeInternet')->findOneBySpeed(20);
            $datacenter->setTypeInternet($typeInternet);
            $em->persist($datacenter);

            $rack = new Rack();
            $rack->setDatacenter($datacenter);
            $em->persist($rack);

            for($i = 0; $i < 2; $i++)
            {
                $server = new Server();
                $typeServer = $em->getRepository('AppBundle:TypeServer')->findOneByName('XS');
                $server->setTypeServer($typeServer);
                $server->setUsageCpu(0);
                $server->setUsageRam(0);
                $server->setUsageHdd(0);
                $server->setUsageLan(0);
                $server->setUsageWan(0);
                $server->setRack($rack);
                $em->persist($server);
            }

            $offer = new Offer();
            $offer->setPlayer($user);
            $offer->setTypeServer($em->getRepository('AppBundle:TypeServer')->findOneByName('XS'));
            $offer->setName('Dedicated XS');
            $offer->setPrice(40);
            $em->persist($offer);

            $offer = new Offer();
            $offer->setPlayer($user);
            $offer->setTypeServer($em->getRepository('AppBundle:TypeServer')->findOneByName('S'));
            $offer->setName('Dedicated S');
            $offer->setPrice(70);
            $em->persist($offer);

            $customer = new Customer();
            $customer->setOffer($offer);
            $customer->setName('John Doe');
            $customer->setQuantity(2);
            $customer->setSubscriptionDate(new \DateTime('now'));
            $em->persist($customer);

            $em->flush();

            return $this->redirectToRoute('dashboard');
        }

        return $this->render(
            'security/register.html.twig',
            array('form' => $form->createView())
        );
    }
}
