<?php

namespace AppBundle\Response;

/**
 * Collection of Reddit article responses.
 */
class RedditArticleCollectionResponse
{
    /**
     * @var RedditArticleResponse[]
     */
    private $collection = [];

    /**
     * @param RedditArticleResponse $response
     */
    public function addArticle(RedditArticleResponse $response)
    {
        $this->collection[] = $response;
    }

    /**
     * Returns the first article response.
     *
     * @return RedditArticleResponse
     */
    public function first()
    {
        return reset($this->collection);
    }
}
