<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 29.06.18
 * Time: 17:38
 */

namespace Repository;


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

    public function find(int $id): Article
    {
        /**
         * @var Article $entity
         */
        $entity = $this->em->find(Article::class, $id);

        if (!$entity) {
            throw new NotFoundException('Article does not exists.');
        }

        return $entity;
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