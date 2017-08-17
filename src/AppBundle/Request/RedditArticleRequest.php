<?php

namespace AppBundle\Request;

/**
 * Request to get a collection of Reddit articles.
 */
class RedditArticleRequest
{
    /**
     * @var string
     */
    private $baseUrl = 'https://www.reddit.com';

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $subreddit;

    /**
     * @var int
     */
    private $count;

    /**
     * @var string
     */
    private $before;

    /**
     * @var string
     */
    private $after;

    /**
     * @return string
     */
    public function getSubreddit()
    {
        return $this->subreddit;
    }

    /**
     * @param string $subreddit
     */
    public function setSubreddit($subreddit)
    {
        $this->subreddit = $subreddit;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param int $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }

    /**
     * @return string
     */
    public function getBefore()
    {
        return $this->before;
    }

    /**
     * @param string $before
     */
    public function setBefore($before)
    {
        $this->before = $before;
    }

    /**
     * @return string
     */
    public function getAfter()
    {
        return $this->after;
    }

    /**
     * @param string $after
     */
    public function setAfter($after)
    {
        $this->after = $after;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        $url = $this->baseUrl;

        if ($this->subreddit) {
            $url .= '/r/' . $this->subreddit;
        }

        if ($this->type) {
            $url .= '/' . $this->type;
        }

        $url .= '/.json';

        if ($this->count && $this->after) {
            $query = http_build_query(['count' => $this->count, 'after' => $this->after]);
            $url .= '?' . $query;
        } elseif ($this->count && $this->before) {
            $query = http_build_query(['count' => $this->count, 'before' => $this->before]);
            $url .= '?' . $query;
        }

        return $url;
    }
}
