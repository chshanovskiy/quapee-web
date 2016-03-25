<?php

namespace QuapeeBundle\Proxy\Core;

/**
 * Интерфейс доступа к внешнему сервису
 */
interface ServiceInterface
{
    /**
     * Конструктор
     *
     * @param ServiceCredentials $credentials Реквизиты сервиса
     */
    public function __construct(ServiceCredentials $credentials);

    /**
     * Возвращает данные от внешнего сервиса
     *
     * @param Request $request Запрос
     *
     * @return mixed
     * @throws ServiceException
     */
    public function fetch(Request $request);
}
