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
     * @var string
     */
    private $lastArticleName;

    /**
     * @param RedditArticleResponse $response
     */
    public function addArticle(RedditArticleResponse $response)
    {
        $this->collection[] = $response;
    }

    /**
     * @return string
     */
    public function getLastArticleName()
    {
        return $this->lastArticleName;
    }

    /**
     * @param string $lastArticleName
     */
    public function setLastArticleName($lastArticleName)
    {
        $this->lastArticleName = $lastArticleName;
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
