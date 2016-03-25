<?php

namespace QuapeeBundle\Proxy\Core;

/**
 * Класс представляет из себя фабрику запросов
 */
class RequestFactory
{
    /**
     * Валидатор входных данных
     *
     * @var RequestValidator
     */
    private $validator;

    /**
     * Конструктор
     *
     * @param RequestValidator $validator Валидатор
     */
    public function __construct(RequestValidator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Возвращает запрос из входных данных
     *
     * @param array $json Входные данные
     *
     * @return Request
     *
     * @throws ProxyErrorException
     */
    public function from(array $json)
    {
        $request = new Request();
        $this->validator->validate($request, $json);
        $this->hydrate($request, $json);

        return $request;
    }

    /**
     * Наполняет объект запроса входными данными
     *
     * @param Request $request Запрос
     * @param array   $json    Входные данные
     *
     * @return void
     */
    private function hydrate(Request $request, array $json)
    {
        $fields = array_keys(get_object_vars($request));
        foreach ($fields as $field) {
            $request->$field = $json[$field];
        }
    }
}
