<?php
/**
 * Created by PhpStorm.
 * User: brianf
 * Date: 8/17/17
 * Time: 8:17 AM
 */

namespace AppBundle\Service;

use AppBundle\Request\RedditArticleRequest;
use AppBundle\Response\RedditArticleCollectionResponse;
use AppBundle\Response\RedditArticleResponse;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

/**
 * Service for interacting with Reddit.
 */
class RedditService
{
    /**
     * @var ClientInterface
     */
    private $http;

    /**
     * RedditService constructor.
     */
    public function __construct()
    {
        // This is such a simple dependency, I'm not going to bother injecting it.
        // Especially since we can easily hit production Reddit.
        $this->http = new Client();
    }

    /**
     * @param ClientInterface $http
     */
    public function setHttp(ClientInterface $http)
    {
        $this->http = $http;
    }

    /**
     * @return RedditArticleCollectionResponse
     */
    public function getArticles(RedditArticleRequest $request)
    {
        $response = $this->http->request('GET', $request->getUrl());

        $json = \GuzzleHttp\json_decode((string)$response->getBody(), true);

        $list = new RedditArticleCollectionResponse();

        foreach ($json['data']['children'] as $article) {
            $data = $article['data'];

            if (null === $list->getFirstArticleName()) {
                $list->setFirstArticleName($data['name']);
            }

            $list->addArticle(new RedditArticleResponse($data['title'], $data['url']));
            $list->setLastArticleName($data['name']);
        }

        return $list;
    }
}
