<?php

namespace QuapeeBundle\Proxy\Core;

/**
 * Класс для передачи данных ответа
 */
class Response
{
    /**
     * Ответ
     *
     * @var mixed
     */
    private $result;

    /**
     * Список ошибок
     *
     * @var string[]
     */
    private $errors = [];

    /**
     * Устанавливает ответ
     *
     * @param mixed $result Ответ
     *
     * @return Response
     */
    public function setResult($result)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Добавляет ошибку к списку ошибок
     *
     * @param ResponseError $error Ошибка
     *
     * @return Response
     */
    public function addError(ResponseError $error)
    {
        $this->errors[] = $error->extract();

        return $this;
    }

    /**
     * Возвращает факт успешности ответа
     *
     * @return bool
     */
    public function isSuccess()
    {
        return count($this->errors) === 0;
    }

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
