<?php

namespace App\Controller;



use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
 use App\Entity\Post;
 use Symfony\Component\HttpFoundation\Response;
 use Symfony\Component\HttpFoundation\Request;
 use Symfony\Component\Form\Extension\Core\Type\TextType;
 use Symfony\Component\Form\Extension\Core\Type\SubmitType;
 use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

//test commit 3

class PostController extends Controller
{
    /**
     * @Route("/post", name="post")
      * @Template("/post/index.html.twig")
     */
     public function getPosts()
     {
       $posts = $this->getDoctrine()
           ->getRepository(Post::class)
           ->findAll();

       if (!$posts) {
           throw $this->createNotFoundException(
               'No posts found'
           );
       }


    return array('posts' => $posts);
     }

     public function addPost(Request $request){

       $post = new Post();

        $em = $this->getDoctrine()->getManager();

        $data = json_decode($request->getContent());

        if (isset($data->username)) {
            $post->setUsername($data->username);
        }

        if (isset($data->message)) {
            $entity->setMessage($data->message);
        }


        $em->persist($post);
        $em->flush();

        return $this->json($post);
    }
   }
