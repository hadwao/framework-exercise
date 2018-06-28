<?php
/**
 * Created by PhpStorm.
 * User: hadwao
 * Date: 26.06.18
 * Time: 10:45
 */

namespace Core\Session;


class MessageBox implements MessageBoxInterface
{

    /**
     * @var SessionInterface
     */
    protected $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function addMessage(string $type, $msg)
    {
        $messages = $this->readFromSession();

        $messages[$msg] = $msg;

        $this->writeToSession($messages);
    }

    /**
     * @return string[]
     */
    public function allMessages($purgeAfter = true): array
    {
        $messages = $this->readFromSession();

        if ($purgeAfter) {
            $this->writeToSession([]);
        }

        return $messages;
    }

    /**
     * @return string[]
     */
    protected function readFromSession(): array
    {
        return $this->session->get(self::class, []);
    }

    protected function writeToSession(array $messages)
    {
        return $this->session->set(self::class, $messages);
    }

}