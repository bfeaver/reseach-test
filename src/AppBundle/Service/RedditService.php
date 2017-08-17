<?php
/**
 * Created by PhpStorm.
 * User: brianf
 * Date: 8/17/17
 * Time: 8:17 AM
 */

namespace AppBundle\Service;

use AppBundle\Response\RedditArticleCollectionResponse;
use AppBundle\Response\RedditArticleResponse;
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
     * @param ClientInterface $http
     */
    public function __construct(ClientInterface $http)
    {
        $this->http = $http;
    }

    /**
     * @return RedditArticleCollectionResponse
     */
    public function getArticles()
    {
        $baseUrl = 'https://www.reddit.com/.json';
        $response = $this->http->request('GET', $baseUrl);

        $json = \GuzzleHttp\json_decode((string)$response->getBody(), true);

        $list = new RedditArticleCollectionResponse();

        foreach ($json['data']['children'] as $article) {
            $data = $article['data'];
            $list->addArticle(new RedditArticleResponse($data['title'], $data['url']));
        }

        return $list;
    }
}
