<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Forum;
use AppBundle\Form\ForumType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ForumController
 * @package AppBundle\Controller
 * @Route("/forum")
 */
class ForumController extends Controller
{
    /**
     * @Route("/",name="app_forum_index")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Forum:index.html.twig', array(
            'forums'=>$this->getDoctrine()->getRepository(Forum::class)->findAll()
        ));
    }

    /**
     * @Route("/add",name="app_forum_add")
     * @Route("/edit/{id}",name="app_forum_edit")
     */
    public function addAction(Request $request,Forum $forum = null)
    {
        if($forum===null)
        {
            $forum=new Forum();
        }
        $form = $this->createForm(ForumType::class,$forum);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($forum);
            $em->flush();
            return $this->redirectToRoute('app_forum_index');
        }
        return $this->render('AppBundle:Forum:add.html.twig', array('form'=>$form->createView()
        ));
    }

    /**
     * @Route("/{id}",requirements={"id":"\d+"},name="app_forum_show")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(int $id)
    {
        return $this->render('AppBundle:Forum:show.html.twig', array(
            'forum'=>$this->getDoctrine()->getRepository(Forum::class)->find($id)
        ));
    }

}
