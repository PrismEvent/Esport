<?php

namespace Prism\EsportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PrismEsportBundle:Default:index.html.twig');
    }
}
