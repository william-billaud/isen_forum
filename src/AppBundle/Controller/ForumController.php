<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Forum;
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
     * @Route("/add")
     * @Method("GET")
     */
    public function addAction()
    {
        return $this->render('AppBundle:Forum:add.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/add")
     * @Method("POST")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addPostAction(Request $request)
    {
        $forum= new Forum();
        $forum->setTitle($request->get('title'));
        $forum->setDescription($request->get('description'));

        $em= $this->getDoctrine()->getManager();
        $em->persist($forum);
        $em->flush();

        return $this->redirectToRoute('app_forum_index');
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
