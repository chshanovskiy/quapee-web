<?php

namespace QuapeeBundle\Proxy\Core;

/**
 * Класс для передачи параметров запроса
 */
class Request
{
    /**
     * Метод
     *
     * @var string
     */
    public $method;

    /**
     * Аргументы
     *
     * @var mixed[]
     */
    public $args;

    /**
     * Сервис
     *
     * @var string
     */
    public $service;

    /**
     * Псевдоним
     *
     * @var string
     */
    public $alias;

    /**
     * Приложение
     *
     * @var string
     */
    public $app;

    /**
     * Возвращает внутреннее представление
     *
     * @return mixed[]
     */
    public function extract()
    {
        return get_object_vars($this);
    }
}
