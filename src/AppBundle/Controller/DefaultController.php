<?php

namespace AppBundle\Controller;

use AppBundle\Request\RedditArticleRequest;
use AppBundle\Service\RedditService;
use JMS\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/api", name="api")
     */
    public function apiAction(Request $request, RedditService $redditService, Serializer $serializer)
    {
        // Add validation if time permits
        $redditRequest = new RedditArticleRequest();
        $redditRequest->setType($request->query->get('type'));
        $redditRequest->setSubreddit($request->query->get('subreddit'));
        $redditRequest->setCount($request->query->get('count'));
        $redditRequest->setAfter($request->query->get('after'));

        $response = $redditService->getArticles($redditRequest);

        return new JsonResponse($serializer->serialize($response, 'json'), 200, [], true);
    }
}
