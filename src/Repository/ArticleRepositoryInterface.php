<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 30.06.18
 * Time: 10:57
 */

namespace Repository;

use Entity\Article;

interface ArticleRepositoryInterface
{
    /**
     * @throws NotFoundException
     */
    public function find(int $id): Article;

    public function save(Article $article);

    /**
     * @return Article[]
     */
    public function findAll(): array;
}