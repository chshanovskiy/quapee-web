<?php

namespace QuapeeBundle\Proxy\Core;

/**
 * Класс представляет из себя валидатор параметров запроса
 */
class RequestValidator
{
    const ERROR__FIELD_REQUIRED = '%s is required';

    /**
     * Валидирует входные данные
     *
     * @param Request $request Запрос
     * @param array   $data    Входные данные
     *
     * @return void
     *
     * @throws ProxyErrorException
     */
    public function validate(Request $request, array $data)
    {
        $fields = array_keys(get_object_vars($request));

        foreach ($fields as $field) {
            if (!array_key_exists($field, $data)) {
                $message = sprintf(self::ERROR__FIELD_REQUIRED, $field);
                throw new ProxyErrorException($message);
            }
        }
    }
}
