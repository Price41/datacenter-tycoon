<?php

namespace AppBundle\Controller;

use AppBundle\Form\UserType;
use AppBundle\Entity\User;
use AppBundle\Entity\Datacenter;
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
            $typeDatacenter = $em->getRepository('AppBundle:TypeDatacenter')->find(1);
            $datacenter->setTypeDatacenter($typeDatacenter);
            $typeElectricity = $em->getRepository('AppBundle:TypeElectricity')->find(1);
            $datacenter->setTypeElectricity($typeElectricity);
            $typeInternet = $em->getRepository('AppBundle:TypeInternet')->find(1);
            $datacenter->setTypeInternet($typeInternet);

            $em->persist($datacenter);
            $em->flush();

            return $this->redirectToRoute('dashboard');
        }

        return $this->render(
            'security/register.html.twig',
            array('form' => $form->createView())
        );
    }
}
