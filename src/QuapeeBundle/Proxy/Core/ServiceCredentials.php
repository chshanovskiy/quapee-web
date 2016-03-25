<?php

namespace QuapeeBundle\Proxy\Core;

/**
 * Класс для передачи конфигурации внешнего сервиса
 */
class ServiceCredentials
{
    /**
     * Ссылка на сервис
     *
     * @var string
     */
    public $url;

    /**
     * Пользователь
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
     * @param string $url Ссылка на сервис
     * @param string $user Пользователь
     * @param string $pass Пароль
     */
    public function __construct($url, $user, $pass)
    {
        $this->url = $url;
        $this->user = $user;
        $this->pass = $pass;
    }
}
