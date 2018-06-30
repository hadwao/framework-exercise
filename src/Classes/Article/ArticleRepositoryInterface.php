<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 30.06.18
 * Time: 10:57
 */

namespace Classes\Article;

use Entity\Article;

interface ArticleRepositoryInterface
{
    public function find(int $id): ?Article;

    public function save(Article $article);

    /**
     * @return Article[]
     */
    public function findAll(): array;
}