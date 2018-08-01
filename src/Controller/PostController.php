<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
 use App\Entity\Post;
 use Symfony\Component\HttpFoundation\Response;


class PostController extends Controller
{
    /**
     * @Route("/post", name="post")
     */
     public function index()
     {
         // you can fetch the EntityManager via $this->getDoctrine()
         // or you can add an argument to your action: index(EntityManagerInterface $entityManager)
         $entityManager = $this->getDoctrine()->getManager();

         $post = new Post();
         $post->setUsername('Bas');
         $post->setMessage('I just ate pancakes!');
         $post->setTime('21:00 1 August 2018');

         // tell Doctrine you want to (eventually) save the Product (no queries yet)
         $entityManager->persist($post);

         // actually executes the queries (i.e. the INSERT query)
         $entityManager->flush();

         return new Response('Saved new post with id '.$post->getId());
     }
 }
