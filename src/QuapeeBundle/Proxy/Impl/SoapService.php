<?php

namespace QuapeeBundle\Proxy\Impl;

use Exception;
use QuapeeBundle\Proxy\Core\Credential;
use QuapeeBundle\Proxy\Core\Request;
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
     * @param Credential $credentials Реквизиты сервиса
     */
    public function __construct(Credential $credentials)
    {
        $options = [
            'login'    => $credentials->user,
            'password' => $credentials->pass,
        ];

        $this->adapter = new SoapClient($credentials->uri, $options);
    }

    /**
     * Возвращает данные от внешнего сервиса
     *
     * @param Request $request Запрос
     *
     * @return mixed
     * @throws ServiceException
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
