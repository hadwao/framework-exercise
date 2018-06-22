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
                $this->request->setLoggedUserId($user->getId());
                $this->redirect('/article/index');
            }





        }
        return $this->renderView(
            'user/login.html.twig'
        );
    }

    public function logoutAction()
    {
        $this->request->unsetLoggedUserId();
        $this->redirect('/article/index');
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