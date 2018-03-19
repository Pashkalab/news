<?php

// dependency injection

namespace Model\Repository;

use Model\Entity\News;

class NewsRepository
{
    /**
     * @var \PDO
     */ 
    protected $pdo;
    
    public function setPdo(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function save(News $news, $id){
        $sql = 'insert into news (title, description) values (:title, :description) WHERE news.id = :news_id';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([
            'title' => $news->getTitle(),
            'description' => $news->getDescription(),
            'news_id' => $news->$id
        ]);
    }


    
    public function findAll(array $options = [], $hydrationArray = false)
    {

        $collection = [];
        $sth = $this->pdo->query('select * from news');
        
        if ($hydrationArray) {
            return $res = $sth->fetchAll(\PDO::FETCH_ASSOC);
        }
        
        while ($res = $sth->fetch(\PDO::FETCH_ASSOC)) {
            $news = (new News())
                ->setId($res['id'])
                ->setTitle($res['title'])
                ->setDescription($res['description'])
            ;
            
            $collection[] = $news;
        }
        
        return $collection;
    }

    public function find($id)
    {
        $collection = [];
        $sth = $this->pdo->prepare('select * from news where news.id = :id');
        $sth->execute(['id' => $id]);

        $res = $sth->fetch(\PDO::FETCH_ASSOC);

        if (!$res) {
            return null;
        }

        return (new News())
            ->setId($res['id'])
            ->setTitle($res['title'])
            ->setDescription($res['description'])

        ;
    }


}