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
        if ($this->getRequest()->isPost()) {
            $user = $this
                ->entityManager
                ->getRepository(User::class)
                ->findOneBy([
                    'name' => $this->getRequest()->postValue('login_name'),
                    'password' => $this->getRequest()->postValue('login_password'),
                ]);

            if ($user) {
                $this->userService->login($user->getId());
                $this->flash->addMessage('success', 'You have signed up');
                return $this->redirect('/article/index');
            } else {
                $this->flash->addMessage('error', 'Incorrect user or password');
            }
        }
        return $this->renderView(
            'user/login'
        );
    }

    public function logoutAction()
    {
        $this->userService->logout();
        $this->flash->addMessage('success','You have been logged out');
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