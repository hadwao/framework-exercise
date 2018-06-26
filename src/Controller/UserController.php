<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 21.06.18
 * Time: 22:29
 */

namespace Controller;


use Entity\User;

class UserController extends AbstractController
{
    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function loginAction()
    {
        if ($this->getRequest()->getRequestMethod() == 'POST') {
            $user = $this
                ->entityManager
                ->getRepository(User::class)
                ->findOneBy([
                    'name' => $this->getRequest()->getPostValue('login_name'),
                    'password' => $this->getRequest()->getPostValue('login_password'),
                ]);

            if ($user) {
                $this->session->setParameter('user_id', $user->getId());
                $this->flash->setFlash('success', 'You have signed up');
                return $this->redirect('/article/index');
            } else {
                $this->flash->setFlash('error', 'Incorrect user or password');
            }
        }
        return $this->renderView(
            'user/login'
        );
    }

    public function logoutAction()
    {
        $this->session->unsetParameter('user_id');
        $this->flash->setFlash('success','You have been logged out');
        return $this->redirect('/article/index');
    }

    public function createAction()
    {
        $user = new User();
        $user->setName('test');
        $user->setPassword('test');
        $user->setRoles(['user']);

        $this->entityManager->persist($user);
        $this->entityManager->flush($user);

        return 'ok';
    }
}