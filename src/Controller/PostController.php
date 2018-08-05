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

     /**
     * @param Post $post
     *
     * @Route("/{id}/delete", requirements={"id" = "\d+"}, name="deletepost")
     * @return RedirectResponse
     *
     */
public function deletePost(Post $post){

  $em = $this->getDoctrine()->getManager();

  $toDeletePost = $em->getRepository(Post::class)->find($post);

  if (!$toDeletePost) {
    throw $this->createNotFoundException(
        'No product found for id '.$id
    );

    $em->remove($toDeletePost);
    $em->flush();
}
return $this->redirect($this->generateUrl('post'));



   }


 }
