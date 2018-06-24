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
            'article/index.html.twig',
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
            ->getRepository(Article::class)->find($this->getParameter('id'));

        if (!$article) {
            $this->redirect404();
        }

        return $this->renderView(
            'article/show.html.twig',
            [
                'title' => 'Artykuł '. $article->getTitle(),
                'article' => $article,
            ]
        );


    }

    public function createAction()
    {
        if ((!$this->user) || (!$this->user->hasCredentials('user'))) {
            return $this->redirect403();
        }

        $article = new Article();
        $article->setUser($this->user);

        if ($this->request->getRequestMethod() == 'POST') {

            $article
                ->setBody($this->request->getPostValue('article_body'))
                ->setTitle($this->request->getPostValue('article_title'));
            $this->entityManager->persist($article);
            $this->entityManager->flush();

            $this->session->setFlash('success', 'Stworzyłeś nowy artykuł');

            $this->redirect('/article/index');
        }

        return $this->renderView(
            'article/create.html.twig',
            ['article' => $article]
        );
    }

    public function editAction()
    {
        //uzytkownik musi byc zalogowany
        if ((!$this->user) || (!$this->user->hasCredentials('user'))) {
            return $this->redirect403();
        }

        $article = null;
        if ($this->getParameter('id')) {
            $article = $this->entityManager->find(Article::class, $this->getParameter('id'));
        }

        if (!$article) {
            $this->redirect404();
        }

        //tylko admin lub wlasciciel moze edytowac artykul
        if (!($this->user->hasCredentials('admin') || ($this->user === $article->getUser())))
        {
            $this->redirect403();
        }


        if (!$article) {
            return $this->redirect404();
        }

        if ($this->request->getRequestMethod() == 'POST') {

            $article
                ->setBody($this->request->getPostValue('article_body'))
                ->setTitle($this->request->getPostValue('article_title'));
            $this->entityManager->persist($article);
            $this->entityManager->flush();

            $this->session->setFlash('success', 'Zmiany w artykule zostały zapisane');

            $this->redirect('/article/index');
        }

        return $this->renderView(
            'article/create.html.twig',
            ['article' => $article]
        );
    }
}