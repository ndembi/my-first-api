<?php

namespace App\Controller;

use App\Entity\Article;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use JMS\Serializer\SerializationContext;

class ArticleController extends Controller
{
    /**
     * @Route("/articles/{id}", name="article_show")
     */
    public function showAction($id)
    {
        //On recupère les arcticles directement en base
        $articles = $this->getDoctrine()
        ->getRepository(Article::class)
        ->find($id);
        //gestion d'erreurs
        if (!$articles) {
            throw $this->createNotFoundException(
            "Pas d'article avec cette id: ".$id
        );
        }
        // on sérialise la donnée au format JSON
        $data = $this->get('jms_serializer')->serialize($articles, 'json',
        SerializationContext::create()->setGroups(array('detail')));
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/articles", name="article_create")
     * @Method({"POST"})
     */
    public function createAction(Request $request)
    {
        //On recupère les données depuis le formulaire
        $data = $request->getContent();
        //On les décodent
        $article = $this->get('jms_serializer')->deserialize($data, 'App\Entity\Article', 'json');

        //On insert les infos dans la database

        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();
        var_dump($article);

        return new Response('', Response::HTTP_CREATED);
    }

      /**
     * @Route("/article", name="article_create2")
     * @Method({"GET"})
     */
    public function listArticleAction()
    {
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();

        $data = $this->get('jms_serializer')->serialize($articles, 'json', SerializationContext::create()->setGroups(array('list')));

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
