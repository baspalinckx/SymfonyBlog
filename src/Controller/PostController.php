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

         $em = $this->getDoctrine()->getEntityManager();

         $post = new Post();
         $post->setUsername('Bas');
         $post->setMessage('This post is for demo purposes');
         $post->setTime(date('d/m/Y'));

         $em->persist($post);
         $em->flush();
       }

        return array('posts' => $posts);
         }


         /**
          * @Route("/post/add" , name="addpost" )
          */

         public function addPost(Request $request)
         {

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

                 // Populate

                 $form->handleRequest($request);
                 // Check
                 if($form->isSubmitted()) {
                     // Fill the entity
                     $post->setUsername($form['username']->getData());
                     $post->setMessage($form['message']->getData());
                     $post->setTime(date('d/m/Y'));
                     $em->persist($post);
                     $em->flush();

                     return $this->redirect($this->generateUrl('post'));

                   }

                 return $this->render('form/index.html.twig',array(
                   'form' => $form->createView(),
                       ));
           }


     /**
     * @param Post $post
     *
     * @Route("post/{id}/delete", requirements={"id" = "\d+"}, name="deletepost")
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


    }

    $em->remove($toDeletePost);
    $em->flush();

    return $this->redirect($this->generateUrl('post'));

   }

   /**
   * @param Post $post
   *
   * @Route("post/{id}/update", requirements={"id" = "\d+"}, name="updatepost")
   * @return RedirectResponse
   *
   */

    public function updatePost(Request $request)
 {

        $id = $request->get('id');

         // EntityManager
         $em = $this->getDoctrine()->getEntityManager();

         // New entity
         $toUpdatePost = $em->getRepository(Post::class)->find($id);

         // Build the form
         $form = $this->createFormBuilder()
         ->add('username', TextType::class, array(
               'label' => 'Username: ',
               'data' => $toUpdatePost->getUsername()
          ))
         ->add('message', TextType::class,  array(
               'label' => 'Message: ',
               'data' => $toUpdatePost->getMessage()
          ))
         ->add('submit', SubmitType:: class)
         ->getForm();

         // Populate

         $form->handleRequest($request);
         // Check
         if($form->isSubmitted()) {
             // Fill the entity
             $toUpdatePost->setUsername($form['username']->getData());
             $toUpdatePost->setMessage($form['message']->getData());
             $em->persist($toUpdatePost);
             $em->flush();

             return $this->redirect($this->generateUrl('post'));

           }

         return $this->render('form/index.html.twig',array(
           'form' => $form->createView(),
               ));
   }
 }
