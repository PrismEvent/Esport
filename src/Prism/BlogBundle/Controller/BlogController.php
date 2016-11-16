<?php

namespace Prism\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{
	//Action: Add an article
    public function addAction() 
    {

    }

    //Action: Edit an article (need the id)
    public function editAction($id)
    {
    	$em = $this->getDoctrine()->getManager();

    	$article = $em->getRepository('PrismBlogBundle:Article')->find($id);

    	if (null === $article) 
    	{
      		throw new NotFoundHttpException("L'article que vous chezchez n'existe pas.");
    	}
    }

    //Action: View an article (need the id)
    public function viewAction($id)
    {
    	$em = $this->getDoctrine()->getManager();

    	$article = $em->getRepository('PrismBlogBundle:Article')->find($id);

    	if (null === $article) 
    	{
      		throw new NotFoundHttpException("L'article que vous chezchez n'existe pas.");
    	}

    	return $this->render('PrismBlogBundle:Blog:view.html.twig', array(
    		'article' => $article));
    }
}