<?php

namespace QuapeeBundle\Proxy\Core;

/**
 * Интерфейс для фабрик сервисов
 */
interface ServiceFactoryInterface
{
    /**
     * Конструктор
     *
     * @param ServiceCredentialsRepositoryInterface $credentials Хранилище реквизитов
     */
    public function __construct(ServiceCredentialsRepositoryInterface $credentials);

    /**
     * Возвращает сервис, который соответствует запросу
     *
     * @param Request $request Запрос
     *
     * @return ServiceInterface
     */
    public function match(Request $request);
}
