<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Forum;
use AppBundle\Entity\Topic;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class TopicController
 * @package AppBundle\Controller
 * @Route("/forum/{forum_id}/topic",requirements={"forum_id":"\d+"})
 */
class TopicController extends Controller
{
    /**
     * @Route("/{id}",requirements={"id":"\d+"},name="app_topic_index")
     * @param int $forum_id
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(int $forum_id,int $id)
    {
        return $this->render('AppBundle:Topic:index.html.twig',[
                'forum'=>$this->getDoctrine()->getRepository(Forum::class)->find($forum_id),
                'topic'=>$this->getDoctrine()->getRepository(Topic::class)->find($id)
            ]
        );
    }

    /**
     * @Route("/add")
     * @Method("GET")
     * @param int $forum_id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction(int $forum_id)
    {
        return $this->render('AppBundle:Topic:add.html.twig', array(
            'forum'=>$this->getDoctrine()->getRepository(Forum::class)->find($forum_id)
        ));
    }

    /**
     * @Route("/add")
     * @Method("Post")
     * @param int $forum_id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addPostAction(int $forum_id,Request $request)
    {
        $forum=$this->getDoctrine()->getRepository(Forum::class)->find($forum_id);
        $topic=new Topic();
        $topic->setTitle($request->get('title'));
        $topic->setAuthor($request->get('author'));
        $topic->setForum($forum);
        $topic->setCreation(new \DateTime());

        $em=$this->getDoctrine()->getManager();
        $em->persist($topic);
        $em->flush();


        return $this->redirectToRoute('app_forum_show',[
            'id'=>$forum->getId()
        ]);
    }

    /**
     * @Route("/remove/{id}",requirements={"id":"\d+"})
     * @param int $forum_id
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeAction(int $forum_id,$id)
    {
        $topic=$this->getDoctrine()->getRepository(Topic::class)->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($topic);
        $em->flush();
        return $this->redirectToRoute('app_forum_show',['id'=>$forum_id]);
    }
}
