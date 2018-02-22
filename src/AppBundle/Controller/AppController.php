<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AppController extends Controller
{
    /**
     * @Route("/contact", name="app.contact")
     */
    public function contactAction()
    {
        return $this->render('contact/contact.html.twig');
    }
}
