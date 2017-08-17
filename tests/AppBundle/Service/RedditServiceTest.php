<?php
namespace Tests\AppBundle\Service;

use AppBundle\Request\RedditArticleRequest;
use AppBundle\Response\RedditArticleResponse;
use AppBundle\Service\RedditService;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use PHPUnit\Framework\TestCase;

class RedditServiceTest extends TestCase
{
    /**
     * @var RedditService
     */
    private $service;

    /**
     * @var ClientInterface
     */
    private $http;

    protected function setUp()
    {
        $this->http = new Client();
        $this->service = new RedditService($this->http);
    }

    public function testGetArticles()
    {
        $request = new RedditArticleRequest();
        $response = $this->service->getArticles($request);

        /** @var RedditArticleResponse $articleResponse */
        $articleResponse = $response->first();

        $this->assertNotEmpty($articleResponse->getTitle());
        $this->assertNotEmpty($articleResponse->getLink());
        $this->assertNotEmpty($response->getLastArticleName());
    }
}
