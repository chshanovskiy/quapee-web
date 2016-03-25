<?php

namespace QuapeeBundle\Proxy\Core;

/**
 * Класс для уточнения ошибок внешнего сервиса
 */
class ServiceException extends \ErrorException
{
    const TEMPLATE = 'Quapee Service Error: %s';

    /**
     * Конструктор
     *
     * @param string $message Ошибка
     */
    public function __construct($message)
    {
        parent::__construct(sprintf(self::TEMPLATE, $message));
    }
}
