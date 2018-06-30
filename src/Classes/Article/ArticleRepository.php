<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 29.06.18
 * Time: 17:38
 */

namespace Classes\Article;


use Doctrine\ORM\EntityManager;
use Entity\Article;

class ArticleRepository implements ArticleRepositoryInterface
{
    /**
     * @var EntityManager
     */
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function find(int $id): ?Article
    {
        return $this->em->find(Article::class, $id);
    }

    /**
     * @return Article[]
     */
    public function findAll(): array
    {
        return $this->em->getRepository(Article::class)->findAll();
    }

    public function save(Article $article)
    {
        $this->em->persist($article);
        $this->em->flush();
    }
}