<?php

namespace QuapeeBundle\Proxy\Impl;

use Exception;
use QuapeeBundle\Proxy\Core\Request;
use QuapeeBundle\Proxy\Core\ServiceCredentials;
use QuapeeBundle\Proxy\Core\ServiceException;
use QuapeeBundle\Proxy\Core\ServiceInterface;
use SoapClient;

/**
 * Класс представляет из себя внешний SOAP сервис
 */
class SoapService implements ServiceInterface
{
    /**
     * Клиент
     *
     * @var SoapClient
     */
    private $adapter;

    /**
     * Конструктор
     *
     * @param ServiceCredentials $credentials Реквизиты сервиса
     *
     * @codeCoverageIgnore
     */
    public function __construct(ServiceCredentials $credentials)
    {
        $options = [
            'login'    => $credentials->user,
            'password' => $credentials->pass,
        ];

        $this->adapter = new SoapClient($credentials->url, $options);
    }

    /**
     * Возвращает данные от внешнего сервиса
     *
     * @param Request $request Запрос
     *
     * @return mixed
     * @throws ServiceException
     *
     * @codeCoverageIgnore
     */
    public function fetch(Request $request)
    {
        try {
            return $this->adapter->{$request->method}($request->args);
        } catch (Exception $e) {
            throw new ServiceException($e->getMessage());
        }
    }
}
