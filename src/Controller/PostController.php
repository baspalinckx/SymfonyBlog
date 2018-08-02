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
       $posts = $this->getDoctrine()
           ->getRepository(Post::class)
           ->findAll();

      // echo $posts


       if (!$posts) {
           throw $this->createNotFoundException(
               'No posts found'
           );
       }


       return $this->render('post/index.html.twig', ['posts' => $posts]);
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


         return new Response('Check out this great post: '.$post->getMessage());

         // or render a template
         // in the template, print things with {{ product.name }}
         // return $this->render('product/show.html.twig', ['product' => $product]);
     }





 }
