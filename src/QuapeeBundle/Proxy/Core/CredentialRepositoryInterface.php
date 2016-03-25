<?php

namespace QuapeeBundle\Proxy\Core;

/**
 * Интерфейс для связи с хранилищем
 */
interface CredentialRepositoryInterface
{
    /**
     * Возвращает реквизиты доступа к сервису
     *
     * @param Request $request Запрос
     *
     * @return Credential
     * @throws ProxyErrorException
     */
    public function find(Request $request);
}
