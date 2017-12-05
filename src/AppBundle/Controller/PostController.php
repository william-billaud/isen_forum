<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Forum;
use AppBundle\Entity\Post;
use AppBundle\Entity\Topic;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PostController
 * @package AppBundle\Controller
 * @Route("/forum/{forum_id}/topic/{topic_id}/post",requirements={"forum_id"="\d+","topic_id":"\d+"})
 */
class PostController extends Controller
{
    /**
     * @Route("/add")
     * @Method("GET")
     */
    public function AddAction($forum_id, $topic_id)
    {
        return $this->render('AppBundle:Post:add.html.twig', array(
            "forum"=>$this->getDoctrine()->getRepository(Forum::class)->find($forum_id),
            "topic"=>$this->getDoctrine()->getRepository(Topic::class)->find($topic_id)
        ));
    }

    /**
     * @Route("/add")
     * @Method("POST")
     */
    public function AddPostAction($forum_id, $topic_id,Request $request)
    {

        $post= new Post();
        $topic=$this->getDoctrine()->getRepository(Topic::class)->find($topic_id);
        $post->setAutheur($request->get('author'));
        $post->setMessage($request->get('message'));
        $post->setCreation(new \DateTime());
        $post->setTopic($topic);

        $em= $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        return $this->redirectToRoute('app_topic_index',["forum_id"=>$forum_id,"id"=>$topic_id]);
    }

    /**
     * @Route("/remove/{id}",requirements={"id"="\d+"})
     * @param $forum_id
     * @param $topic_id
     * @param $id
     */
    public function RemoveAction($forum_id, $topic_id,$id)
    {
        $post= $this->getDoctrine()->getRepository(Post::class)->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();
        return $this->redirectToRoute('app_topic_index',["forum_id"=>$forum_id,"id"=>$topic_id]);
    }




}
