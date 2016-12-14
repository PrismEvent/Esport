<?php

namespace Prism\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Prism\BlogBundle\Entity\Article;
use Prism\BlogBundle\Form\ArticleType;

class BlogController extends Controller
{
	//Action: Add an article
    public function addAction(Request $request) 
    {
    	$article = new Article();

    	$form = $this->get('form.factory')->create(ArticleType::class, $article);

    	if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
    	{
    		$em = $this->getDoctrine()->getManager();

    		$em->persist($article);
    		$em->flush();

    		$request->getSession()->getFlashBag()->add('notice', 'Votre article a bien été enregistré.');

    		return $this->redirectToRoute('prism_blog_view', array('id' => $article->getId()));
    	}

    	return $this->render('PrismBlogBundle:Blog:formAdd.html.twig', array(
    		'form' => $form->createView()));
    }

    //Action: Edit an article (need the id)
    public function editAction($id, Request $request)
    {
    	$em = $this->getDoctrine()->getManager();

    	$article = $em->getRepository('PrismBlogBundle:Article')->find($id);

    	if (null === $article) 
    	{
      		throw new NotFoundHttpException("L'article que vous chezchez n'existe pas.");
    	}

    	$form = $this->get('form.factory')->create(ArticleType::class, $article);

    	if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) 
    	{
      		$em->flush();

      		$request->getSession()->getFlashBag()->add('notice', 'Votre article a bien été ajouté.');

      		return $this->redirectToRoute('prism_blog_view', array('id' => $article->getId()));
    	}

    	return $this->render('PrismBlogBundle:Blog:formEdit.html.twig', array(
    		'article' => $article,
    		'form'   => $form->createView()));
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