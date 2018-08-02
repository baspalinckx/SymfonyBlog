<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
 use App\Entity\Post;
 use Symfony\Component\HttpFoundation\Response;
//test commit 3

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
         // $entityManager->flush();

         $products = $repository->findAll();


         return new Response('Saved new post with id '.$products->getMessage());
     }

     /**
      * @Route("/post/{id}", name="product_show")
      */
     public function show($id)
     {
         $post = $this->getDoctrine()
             ->getRepository(Post::class)
             ->find($id);

         if (!$post) {
             throw $this->createNotFoundException(
                 'No product found for id '.$id
             );
         }

         return new Response('Check out this great product: '.$post->getMessage());

         // or render a template
         // in the template, print things with {{ product.name }}
         // return $this->render('product/show.html.twig', ['product' => $product]);
     }





 }
