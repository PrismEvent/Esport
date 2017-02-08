<?php

namespace Prism\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PrismUserBundle:Default:index.html.twig');
    }
}
