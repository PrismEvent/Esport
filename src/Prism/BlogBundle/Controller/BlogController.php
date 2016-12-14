<?php

namespace Prism\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Prism\BlogBundle\Entity\Article;
use Prism\BlogBundle\Form\ArticleType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class BlogController extends Controller
{
	//Action: Add an article
    public function addAction(Request $request) 
    {
    	$article = new Article();

    	$formBuilder  = $this->get('form.factory')->createBuilder(ArticleType::class, $article);
		$formBuilder
			->add('author',    TextType::class)
			->add('date',      DateTimeType::class)
			->add('title',     TextType::class)
			->add('content',   TextareaType::class, array('attr' => array('class'=>'tinymce')))
			->add('save',      SubmitType::class);
		$form = $formBuilder->getForm();

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
    public function viewlistAction($id)
    {
    	$em = $this->getDoctrine()->getManager();

    	$articles = $em->getRepository('PrismBlogBundle:Article')->findAll();

    	if (null === $articles) 
    	{
      		throw new NotFoundHttpException("L'article que vous cherchez n'existe pas.");
    	}

    	return $this->render('PrismBlogBundle:Blog:viewlist.html.twig', array(
    		'articles' => $articles));
    }

    //Action: View an article (need the id)
    public function viewAction($id)
    {
    	$em = $this->getDoctrine()->getManager();

    	$article = $em->getRepository('PrismBlogBundle:Article')->find($id);

    	if (null === $article) 
    	{
      		throw new NotFoundHttpException("L'article que vous cherchez n'existe pas.");
    	}

    	return $this->render('PrismBlogBundle:Blog:view.html.twig', array(
    		'article' => $article));
    }
}