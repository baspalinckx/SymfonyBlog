<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\Entity\Post;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FormController extends Controller
{
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

          // $data = json_decode($request->getContent());
          //
          // if (isset($data->username)) {
          //     $post->setUsername($data->username);
          // }
          //
          // if (isset($data->message)) {
          //     $entity->setMessage($data->message);
          // }
          //
          //
          // $em->persist($post);
          // $em->flush();



          return $this->render('form/index.html.twig',array(
            'form' => $form->createView(),
                ));
    }
  }
