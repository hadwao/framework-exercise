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

    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
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

    /**
     * @return string
     * @throws \Core\Dispatcher\PageNotFoundException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function showAction()
    {
        $article = $this
            ->entityManager
            ->getRepository(Article::class)->find($this->getParameter('id'));

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

    /**
     * @return string
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @throws \Core\Exception\AccessForbiddenException
     */
    public function createAction()
    {
        if ($this->isUserSigned()) {
            return $this->frontController->forward403();
        }

        $article = new Article();
        $article->setUser($this->user->getEntity());

        if ($this->request->getRequestMethod() == 'POST') {

            $article
                ->setBody($this->request->getPostValue('article_body'))
                ->setTitle($this->request->getPostValue('article_title'));
            $this->entityManager->persist($article);
            $this->entityManager->flush();

            $this->flash->setFlash('success', 'Stworzyłeś nowy artykuł');

            return $this->redirect('/article/index');
        }

        return $this->renderView(
            'article/create',
            ['article' => $article]
        );
    }

    /**
     * @return string
     * @throws \Core\Dispatcher\PageNotFoundException
     * @throws \Core\Exception\AccessForbiddenException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function editAction()
    {
        $article = null;
        if ($this->getParameter('id')) {
            $article = $this->entityManager->find(Article::class, $this->getParameter('id'));
        }

        if (!$article) {
            return $this->frontController->forward404();
        }

        if (!$this->isUserAllowedToEditArticle($article) ) {
            return $this->frontController->forward403();
        }

        if ($this->request->getRequestMethod() == 'POST') {

            $article
                ->setBody($this->request->getPostValue('article_body'))
                ->setTitle($this->request->getPostValue('article_title'));
            $this->entityManager->persist($article);
            $this->entityManager->flush();

            $this->flash->setFlash('success', 'Zmiany w artykule zostały zapisane');

            return $this->redirect('/article/index');
        }

        return $this->renderView(
            'article/create',
            ['article' => $article]
        );
    }

    /**
     * @param $article
     * @throws \Core\Exception\AccessForbiddenException
     */
    private function isUserAllowedToEditArticle(Article $article): bool
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