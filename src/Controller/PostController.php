<?php

namespace App\Controller;



use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
 use App\Entity\Post;
 use Symfony\Component\HttpFoundation\Response;
 use Symfony\Component\HttpFoundation\Request;
 use Symfony\Component\Form\Extension\Core\Type\TextType;
 use Symfony\Component\Form\Extension\Core\Type\SubmitType;
//test commit 3

class PostController extends Controller
{
    /**
     * @Route("/post", name="post")
     */
     public function index()
     {
       $posts = $this->getDoctrine()
           ->getRepository(Post::class)
           ->findAll();



       if (!$posts) {
           throw $this->createNotFoundException(
               'No posts found'
           );
       }


       return $this->render('post/index.html.twig', ['posts' => $posts]);


     }

     public function addPost(Request $request)
     {
         if ($request->getMethod() == 'POST') {
             // EntityManager
             $em = $this->getDoctrine()->getEntityManager();

             // New entity
             $post = new Post();

             // Build the form
             $form = $this->createFormBuilder()
             ->add('username', TextType::class)
             ->add('message', TextType::class)
             ->add('submit', SubmitType:: class)
             ->getForm();
             //
             // // Populate
             // $form->bindRequest($request);
             //
             // // Check
             // if($form->isValid()) {
             //     // Fill the entity
             //     $post->setName($form['username']->getData());
             //     $post->setMessage($form['message']->getData());
             //     $em->persist($post);
             //     $em->flush();
             //   }

           }
           return $this->render('post/index.html.twig',array(
                   'form' => $form->createView(),
           ));
       }
     }
