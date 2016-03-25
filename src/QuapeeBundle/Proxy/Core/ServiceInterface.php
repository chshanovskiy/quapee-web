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
     * @param Credential $credentials Реквизиты сервиса
     */
    public function __construct(Credential $credentials);

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
