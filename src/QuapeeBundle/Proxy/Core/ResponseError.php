<?php

namespace QuapeeBundle\Proxy\Core;

/**
 * Класс для передачи ошибок ответа
 */
class ResponseError
{
    /**
     * Ошибка
     *
     * @var string
     */
    private $description;

    /**
     * Конструктор
     *
     * @param string $error Ошибка
     */
    public function __construct($error)
    {
        $this->description = $error;
    }

    /**
     * Возвращает внутреннее представление
     *
     * @return array
     */
    public function extract()
    {
        return get_object_vars($this);
    }
}
