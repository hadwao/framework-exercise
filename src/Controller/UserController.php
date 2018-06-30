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
            $user = $this->getRequest()->postValue('login_name');
            $password = $this->getRequest()->postValue('login_password');


            if ($this->userService->login($user, $password)) {
                $this->flash->addMessage('success', 'You have signed up');
                return $this->redirect('/article/index');
            }

            $this->flash->addMessage('error', 'Incorrect user or password');
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
}