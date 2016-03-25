<?php

namespace QuapeeBundle\Proxy\Core;

/**
 * Интерфейс для связи с хранилищем
 */
interface ServiceCredentialsRepositoryInterface
{
    /**
     * Возвращает реквизиты доступа к сервису
     *
     * @param Request $request Запрос
     *
     * @return ServiceCredentials
     */
    public function find(Request $request);
}
