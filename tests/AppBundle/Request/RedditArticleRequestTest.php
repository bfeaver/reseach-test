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

    public function testForwardPagination()
    {
        $request = new RedditArticleRequest();
        $request->setCount(25);
        $request->setAfter('abc123');

        $this->assertEquals('https://www.reddit.com/.json?count=25&after=abc123', $request->getUrl());
    }

    public function testBackwardPagination()
    {
        $request = new RedditArticleRequest();
        $request->setCount(26);
        $request->setBefore('abc123');

        $this->assertEquals('https://www.reddit.com/.json?count=26&before=abc123', $request->getUrl());
    }

    public function testSearch()
    {
        $request = new RedditArticleRequest();
        $request->setQuery('stuff');

        $this->assertEquals('https://www.reddit.com/search/.json?q=stuff', $request->getUrl());
    }

    public function testSearchPagination()
    {
        $request = new RedditArticleRequest();
        $request->setQuery('stuff');
        $request->setCount(25);
        $request->setAfter('abc123');

        $this->assertEquals('https://www.reddit.com/search/.json?count=25&after=abc123&q=stuff', $request->getUrl());
    }
}
