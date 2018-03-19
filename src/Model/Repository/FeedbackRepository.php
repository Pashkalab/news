<?php

namespace Model\Repository;

use Model\Entity\Feedback;

class FeedbackRepository
{
    /**
     * @var \PDO
     */ 
    protected $pdo;
    
    public function setPdo(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function save(Feedback $feedback)
    {

        $sql = "update news set  title=:title, description=:description WHERE news.id = :news_id";
        $sth = $this->pdo->prepare($sql);
        $sth->execute([
            'title' => $feedback->getTitle(),
            'description' => $feedback->getDescription(),
            'news_id' => $feedback->getId()
        ]);
    }
}