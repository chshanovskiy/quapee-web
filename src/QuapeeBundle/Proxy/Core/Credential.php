<?php

namespace QuapeeBundle\Proxy\Core;

/**
 * Класс для передачи конфигурации внешнего сервиса
 */
class Credential
{
    /**
     * Ссылка на сервис
     *
     * @var string
     */
    public $uri;

    /**
     * Имя пользователя
     *
     * @var string
     */
    public $user;

    /**
     * Пароль
     *
     * @var string
     */
    public $pass;

    /**
     * Конструктор
     *
     * @param string $uri  Ссылка на сервис
     * @param string $user Имя пользователя
     * @param string $pass Пароль
     */
    public function __construct($uri, $user, $pass)
    {
        $this->uri = $uri;
        $this->user = $user;
        $this->pass = $pass;
    }
}
