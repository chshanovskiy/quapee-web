<?php

namespace QuapeeBundle\Proxy\Core;

/**
 * Класс для внутренних ошибок
 */
class ProxyErrorException extends \ErrorException
{
    const TEMPLATE = 'Quapee Internal Error: %s';

    /**
     * Конструктор
     *
     * @param string $message Текст ошибки
     */
    public function __construct($message)
    {
        parent::__construct(sprintf(self::TEMPLATE, $message));
    }
}
