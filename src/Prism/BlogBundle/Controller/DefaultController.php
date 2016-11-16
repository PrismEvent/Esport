<?php

namespace Prism\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PrismBlogBundle:Default:index.html.twig');
    }
}
