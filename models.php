<?php

/** @Annotation */
class FromQuery
{
    public $value;
}

/** @Annotation */
class FromRequest
{
    public $value;
}

class Post
{
    /** @FromQuery("title") */
    private $title;

    /** @FromRequest("body") */
    private $body;

    public function getTitle()
    {
        return $this->title;
    }

    public function getBody()
    {
        return $this->body;
    }
}
