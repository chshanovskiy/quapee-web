<?php

namespace QuapeeBundle\Proxy\Core;

/**
 * Класс проксирует вызовы к внешнему сервису и возвращает ответ
 */
class Proxy
{
    /**
     * Фабрика для получения запроса из входных данных
     *
     * @var RequestFactory
     */
    private $requestFactory;

    /**
     * Фабрика для получения внешнего сервиса
     *
     * @var ServiceFactoryInterface
     */
    private $serviceFactory;

    /**
     * Конструктор
     *
     * @param RequestFactory $requestFactory Фабрика запросов
     * @param ServiceFactoryInterface $serviceFactory Фабрика сервисов
     */
    public function __construct(RequestFactory $requestFactory, ServiceFactoryInterface $serviceFactory)
    {
        $this->requestFactory = $requestFactory;
        $this->serviceFactory = $serviceFactory;
    }

    /**
     * Возвращает ответ на запрос
     *
     * @param array $json Запрос
     *
     * @return Response
     */
    public function pass(array $json)
    {
        $response = new Response();

        try {
            $request = $this->requestFactory->from($json);
            $service = $this->serviceFactory->match($request);
            $entries = $service->fetch($request);
            $response->setResult($entries);
        } catch (\Exception $e) {
            $error = new ResponseError($e->getMessage());
            $response->addError($error);
        }

        return $response;
    }
}
