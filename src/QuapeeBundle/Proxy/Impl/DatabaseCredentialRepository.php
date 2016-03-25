<?php

namespace QuapeeBundle\Proxy\Impl;

use Doctrine\DBAL\Connection;
use QuapeeBundle\Proxy\Core\Credential;
use QuapeeBundle\Proxy\Core\CredentialRepositoryInterface;
use QuapeeBundle\Proxy\Core\ProxyErrorException;
use QuapeeBundle\Proxy\Core\Request;

/**
 * Класс представляет из себя хранилище конфигураций внешних сервисов в базе данных
 */
class DatabaseCredentialRepository implements CredentialRepositoryInterface
{
    const ERROR__URI_NOT_FOUND = 'Service URI not found';
    const SERVICE_URI = 'http://%s/%s?WSDL';

    /**
     * Соединение с базой данных
     *
     * @var Connection
     */
    private $dbc;

    /**
     * Конструктор
     *
     * @param Connection $adapter Соединение с базой данных
     */
    public function __construct(Connection $adapter)
    {
        $this->dbc = $adapter;
    }

    /**
     * Возвращает реквизиты доступа к сервису
     *
     * @param Request $request Запрос
     *
     * @return Credential
     * @throws ProxyErrorException
     */
    public function find(Request $request)
    {
        $data = $this->fetch($request->extract());

        if (!array_key_exists('uri', $data)) {
            throw new ProxyErrorException(self::ERROR__URI_NOT_FOUND);
        }

        return new Credential(
            sprintf(self::SERVICE_URI, $data['uri'], $request->service),
            $data['username'],
            $data['password']
        );
    }

    /**
     * Возвращает данные из хранилища
     *
     * @param string[] $params Параметры запроса
     *
     * @return string[]
     */
    private function fetch(array $params)
    {
        $q = $this->dbc
            ->prepare(
                '
                SELECT
                  alias.uri,
                  credential.username,
                  credential.password
                FROM alias
                  INNER JOIN credential ON alias.credential_id = credential.id
                  INNER JOIN frontend ON alias.frontend_id = frontend.id
                  INNER JOIN frontend_service ON frontend.id = frontend_service.frontend_id
                  INNER JOIN service ON frontend_service.service_id = service.id
                WHERE alias.title = :alias AND frontend.title = :app AND service.title = :service
                LIMIT 1
                '
            );
        $q->bindValue('alias', $params['alias']);
        $q->bindValue('app', $params['app']);
        $q->bindValue('service', $params['service']);
        $q->execute();

        return $q->fetch(\PDO::FETCH_ASSOC);
    }
}
