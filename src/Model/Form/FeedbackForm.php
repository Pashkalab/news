<?php

namespace Model\Form;

class FeedbackForm
{
    public $news_id;
    public $title;
    public $description;
    
    public function __construct($title = null, $description = null,$news_id = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->news_id = $news_id;
    }
    
    public function isValid()
    {
        return !empty($this->title) && !empty($this->description);
    }
}