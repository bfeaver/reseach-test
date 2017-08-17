<?php
namespace AppBundle\Response;

/**
 * Response given from Reddit.
 */
class RedditArticleResponse
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $link;

    /**
     * RedditArticleResponse constructor.
     *
     * @param string $title
     * @param string $link
     */
    public function __construct($title, $link)
    {
        $this->title = $title;
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }
}
