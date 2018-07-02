<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 21.06.18
 * Time: 18:53
 */

namespace Controller;


use Repository\ArticleRepositoryInterface;
use Core\User\LoggedUserServiceInterface;
use Entity\Article;

class ArticleController extends AbstractController
{
    /**
     * @param LoggedUserServiceInterface $a
     * @return \Core\Response\ResponseInterface
     *
     */
    public function indexAction(ArticleRepositoryInterface $articleRepository)
    {
        $articles = $articleRepository->findAll();

        return $this->renderView(
            'article/index',
            [
                'title' => 'Lista artykułów',
                'articles' => $articles,
            ]
        );
    }

    public function showAction(ArticleRepositoryInterface $articleRepository)
    {
        $article = $articleRepository->find($this->requestParam('id'));

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

    public function createAction(ArticleRepositoryInterface $articleRepository)
    {
        if (!$this->isUserSigned()) {
            return $this->frontController->forward403();
        }

        $article = new Article();
        $article->setUser($this->userService->user());

        if ($this->request->isPost()) {

            $article
                ->setBody($this->request->postValue('article_body'))
                ->setTitle($this->request->postValue('article_title'));

            $articleRepository->save($article);

            $this->flash->addMessage('success', 'New article created');

            return $this->redirect('/article/index');
        }

        return $this->renderView(
            'article/create',
            [
                'title' => 'Utwórz nowy artykuł',
                'article' => $article]
        );
    }

    public function editAction(ArticleRepositoryInterface $articleRepository)
    {
        $article = null;
        if ($this->requestParam('id')) {
            $article = $articleRepository->find($this->requestParam('id'));
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

            $articleRepository->save($article);

            $this->flash->addMessage('success', 'Article was successfully saved');

            return $this->redirect('/article/index');
        }

        return $this->renderView(
            'article/create',
            [
                'title' => 'Edytuj artykuł',
                'article' => $article]
        );
    }

    protected function isUserAllowedToEditArticle(Article $article): bool
    {
        if (!$this->isUserSigned()) {
            return false;
        }

        if (($this->userService->hasRole('admin') || ($this->userService->user() === $article->getUser()))) {
            return true;
        } else {
            return false;
        }
    }
}