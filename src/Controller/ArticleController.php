<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 21.06.18
 * Time: 18:53
 */

namespace Controller;


use Entity\Article;

class ArticleController extends AbstractController
{
    public function indexAction()
    {
        $articles = $this->entityManager->getRepository(Article::class)->findAll();

        return $this->renderView(
            'article/index',
            [
                'title' => 'Lista artykułów',
                'articles' => $articles,
            ]
        );
    }

    public function showAction()
    {
        $article = $this
            ->entityManager
            ->getRepository(Article::class)->find($this->requestParam('id'));

        if (!$article) {
            return $this->frontController->forward404();
        }

        return $this->renderView(
            'article/show',
            [
                'title' => 'Artykuł '. $article->getTitle(),
                'article' => $article,
            ]
        );


    }

    public function createAction()
    {
        if ($this->isUserSigned()) {
            return $this->frontController->forward403();
        }

        $article = new Article();
        $article->setUser($this->user->getEntity());

        if ($this->request->isPost()) {

            $article
                ->setBody($this->request->postValue('article_body'))
                ->setTitle($this->request->postValue('article_title'));
            $this->entityManager->persist($article);
            $this->entityManager->flush();

            $this->flash->addMessage('success', 'Stworzyłeś nowy artykuł');

            return $this->redirect('/article/index');
        }

        return $this->renderView(
            'article/create',
            ['article' => $article]
        );
    }

    public function editAction()
    {
        $article = null;
        if ($this->requestParam('id')) {
            $article = $this->entityManager->find(Article::class, $this->requestParam('id'));
        }

        if (!$article) {
            return $this->frontController->forward404();
        }

        if (!$this->isUserAllowedToEditArticle($article) ) {
            return $this->frontController->forward403();
        }

        if ($this->request->isPost()) {

            $article
                ->setBody($this->request->postValue('article_body'))
                ->setTitle($this->request->postValue('article_title'));
            $this->entityManager->persist($article);
            $this->entityManager->flush();

            $this->flash->addMessage('success', 'Zmiany w artykule zostały zapisane');

            return $this->redirect('/article/index');
        }

        return $this->renderView(
            'article/create',
            ['article' => $article]
        );
    }

    protected function isUserAllowedToEditArticle(Article $article): bool
    {
        if (!$this->isUserSigned()) {
            return false;
        }

        if (!($this->user->hasCredentials('admin') || ($this->user->getId() === $article->getUser()->getId()))) {
            return false;
        } else {
            return true;
        }
    }
}