<?php

namespace Prism\EsportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EsportController extends Controller
{
    public function indexAction()
    {
        return $this->render('PrismEsportBundle:Esport:index.html.twig');
    }
}