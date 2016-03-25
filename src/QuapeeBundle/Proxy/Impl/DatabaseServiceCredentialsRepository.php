<?php

namespace QuapeeBundle\Proxy\Impl;

use Doctrine\DBAL\Connection;
use QuapeeBundle\Proxy\Core\Request;
use QuapeeBundle\Proxy\Core\ServiceCredentials;
use QuapeeBundle\Proxy\Core\ServiceCredentialsRepositoryInterface;

/**
 * Класс представляет из себя хранилище конфигураций внешних сервисов в базе данных
 */
class DatabaseServiceCredentialsRepository implements ServiceCredentialsRepositoryInterface
{
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
     *
     * @codeCoverageIgnore
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
     * @return ServiceCredentials
     *
     * @codeCoverageIgnore
     */
    public function find(Request $request)
    {
        $alias = $this->fetch($request->extract());

        return new ServiceCredentials(
            $alias['uri'],
            $alias['username'],
            $alias['password']
        );
    }

    /**
     * Возвращает данные из хранилища
     *
     * @param string[] $params Параметры запроса
     *
     * @return string[]
     *
     * @codeCoverageIgnore
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
