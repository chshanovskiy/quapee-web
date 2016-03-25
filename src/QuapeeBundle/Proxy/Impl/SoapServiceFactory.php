<?php

namespace QuapeeBundle\Proxy\Impl;

use QuapeeBundle\Proxy\Core\CredentialRepositoryInterface;
use QuapeeBundle\Proxy\Core\Request;
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
     * @var CredentialRepositoryInterface
     */
    private $credentialsRepository;

    /**
     * Конструктор
     *
     * @param CredentialRepositoryInterface $credentials Хранилище реквизитов
     */
    public function __construct(CredentialRepositoryInterface $credentials)
    {
        $this->credentialsRepository = $credentials;
    }

    /**
     * Возвращает сервис, который соответствует запросу
     *
     * @param Request $request Запрос
     *
     * @return ServiceInterface
     */
    public function match(Request $request)
    {
        $credentials = $this->credentialsRepository->find($request);

        return new SoapService($credentials);
    }
}
