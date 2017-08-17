<?php

namespace Tests\AppBundle\Request;

use AppBundle\Request\RedditArticleRequest;
use PHPUnit\Framework\TestCase;

class RedditArticleRequestTest extends TestCase
{
    public function testNoSubreddit()
    {
        $request = new RedditArticleRequest();

        $this->assertEquals('https://www.reddit.com/.json', $request->getUrl());
    }

    public function testWithSubreddit()
    {
        $request = new RedditArticleRequest();
        $request->setSubreddit('StarWars');

        $this->assertEquals('https://www.reddit.com/r/StarWars/.json', $request->getUrl());
    }

    public function testGetNewArticles()
    {
        $request = new RedditArticleRequest();
        $request->setType('new');

        $this->assertEquals('https://www.reddit.com/new/.json', $request->getUrl());
    }

    public function testGetNewSubredditArticles()
    {
        $request = new RedditArticleRequest();
        $request->setSubreddit('StarWars');
        $request->setType('new');

        $this->assertEquals('https://www.reddit.com/r/StarWars/new/.json', $request->getUrl());
    }

    public function testPagination()
    {
        $request = new RedditArticleRequest();
        $request->setCount(25);
        $request->setAfter('abc123');

        $this->assertEquals('https://www.reddit.com/.json?count=25&after=abc123', $request->getUrl());
    }
}
