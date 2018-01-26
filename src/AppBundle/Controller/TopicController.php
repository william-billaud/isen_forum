<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Forum;
use AppBundle\Entity\Topic;
use AppBundle\Form\TopicType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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
     * @Route("/add",name="app_topic_add")
     * @Route("/edit/{id_topic}",name="app_topic_edit")
     * @Method("GET")
     * @ParamConverter("forum",options={"id"="forum_id"})
     * @ParamConverter("topic",options={"id"="id_forum"})
     * @param Request $request
     * @param Forum $forum
     * @param Topic|null $topic
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request,Forum $forum,Topic $topic=null)
    {
        if($topic ===null)
        {
            $topic=new Topic();
        }

        $form = $this->createForm(TopicType::class,$topic);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $topic->setForum($forum);
            $topic->setCreation(new \DateTime());
            $em=$this->getDoctrine()->getManager();
            $em->persist($topic);
            $em->flush();
            return $this->redirectToRoute('app_forum_show',['id' =>$forum->getId()]);
        }
        return $this->render('AppBundle:Topic:add.html.twig', array(
            'forum'=>$forum,
            'form'=>$form->createView()
        ));
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
