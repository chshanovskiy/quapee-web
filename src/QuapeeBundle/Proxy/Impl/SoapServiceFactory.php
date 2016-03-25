<?php

namespace QuapeeBundle\Proxy\Impl;

use QuapeeBundle\Proxy\Core\Request;
use QuapeeBundle\Proxy\Core\ServiceCredentialsRepositoryInterface;
use QuapeeBundle\Proxy\Core\ServiceFactoryInterface;
use QuapeeBundle\Proxy\Core\ServiceInterface;

/**
 * Класс представляет из себя фабрику внешних SOAP сервисов
 */
class SoapServiceFactory implements ServiceFactoryInterface
{
    /**
     * Хранилище реквизитов
     *
     * @var ServiceCredentialsRepositoryInterface
     */
    private $credentialsRepository;

    /**
     * Конструктор
     *
     * @param ServiceCredentialsRepositoryInterface $credentials Хранилище реквизитов
     *
     * @codeCoverageIgnore
     */
    public function __construct(ServiceCredentialsRepositoryInterface $credentials)
    {
        $this->credentialsRepository = $credentials;
    }

    /**
     * Возвращает сервис, который соответствует запросу
     *
     * @param Request $request Запрос
     *
     * @return ServiceInterface
     *
     * @codeCoverageIgnore
     */
    public function match(Request $request)
    {
        $credentials = $this->credentialsRepository->find($request);

        return new SoapService($credentials);
    }
}
