<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Forum;
use AppBundle\Entity\Post;
use AppBundle\Repository\ForumRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ForumController extends Controller
{
    /**
     * @Route("/",name="index")
     */
    public function indexAction()
    {
        $repository = new ForumRepository();
        return $this->render('AppBundle:Forum:index.html.twig', array(
            'forums' => $repository->getAll()
        ));
    }

    /**
     * @Route("/forum/add",name="addForum")
     */
    public function addAction()
    {
        // récupère le nom du nouveau forum
        $forumName = $_POST['title'];

        // créee le nouveau forum
        $forum = new Forum();
        $forum->setTitle($forumName);

        // ajoute le forum
        $repository = new ForumRepository();
        $repository->add($forum);

        // redirige vers la page d'accueil
        return $this->redirectToRoute("index");
    }

    /**
     * @param $id
     * @Route("/forum/show/{id}",name="showForum")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($id)
    {
        // récupère l'id du forum
        $forumId = $id;

        // récupère le forum
        $repository = new ForumRepository();


        return $this->render('AppBundle:Forum:forum.html.twig',[
            'forum' => $repository->get($forumId),
            'forumId' => $forumId
        ]);
    }

    /**
     * @Route("/post/add/{id}",name="addPost")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addPostAction($id)
    {
        // récupère l'id du forum
        $forumId = $id;

        // crée le nouveau post, et copie les données
        $post = new Post();
        $post->setTitle($_POST['title']);
        $post->setAuthor($_POST['author']);
        $post->setDate($_POST['date']);
        $post->setContent($_POST['content']);

        $repository = new ForumRepository();
        $repository->addPost($forumId, $post);

        // redirige vers le forum
        return $this->redirectToRoute("showForum",array("id"=>$forumId));
    }

}
