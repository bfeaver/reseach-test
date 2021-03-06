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

    protected function setUp()
    {
        $this->service = new RedditService();
    }

    public function testGetArticles()
    {
        $request = new RedditArticleRequest();
        $response = $this->service->getArticles($request);

        /** @var RedditArticleResponse $articleResponse */
        $articleResponse = $response->first();

        $this->assertNotEmpty($articleResponse->getTitle());
        $this->assertNotEmpty($articleResponse->getLink());
        $this->assertNull($response->getFirstArticleName());
        $this->assertNotEmpty($response->getLastArticleName());
    }
}
