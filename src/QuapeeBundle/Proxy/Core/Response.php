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
     * Возвращает сериализованное json представление
     *
     * @return string
     */
    public function json()
    {
        return json_encode(
            $this->extract(),
            JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE
        );
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
