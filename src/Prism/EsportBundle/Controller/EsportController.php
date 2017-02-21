<?php

namespace Prism\EsportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EsportController extends Controller
{
    public function indexAction()
    {
        return $this->render('PrismEsportBundle:Esport:index.html.twig');
    }

    public function partenairesAction()
    {
        return $this->render('PrismEsportBundle:Esport:partenaires.html.twig');
    }

    public function calendrierAction()
    {
        return $this->render('PrismEsportBundle:Esport:calendrier.html.twig');
    }
}