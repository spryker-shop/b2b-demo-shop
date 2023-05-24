<?php

use Spryker\Shared\Propel\PropelConstants;
use Spryker\Zed\Propel\PropelConfig;

$dsn = sprintf(
    '%s:host=%s;port=%d;dbname=%s',
    $config[PropelConstants::ZED_DB_ENGINE],
    $config[PropelConstants::ZED_DB_HOST],
    $config[PropelConstants::ZED_DB_PORT],
    $config[PropelConstants::ZED_DB_DATABASE],
);

$connections = [
    'pgsql' => [
        'adapter' => PropelConfig::DB_ENGINE_PGSQL,
        'dsn' => $dsn,
        'user' => $config[PropelConstants::ZED_DB_USERNAME],
        'password' => $config[PropelConstants::ZED_DB_PASSWORD],
        'settings' => [],
        'slaves' => [],
    ],
    'mysql' => [
        'adapter' => PropelConfig::DB_ENGINE_MYSQL,
        'dsn' => $dsn,
        'user' => $config[PropelConstants::ZED_DB_USERNAME],
        'password' => $config[PropelConstants::ZED_DB_PASSWORD],
        'settings' => [
            'charset' => 'utf8',
            'queries' => [
                'utf8' => 'SET NAMES utf8 COLLATE utf8_unicode_ci, COLLATION_CONNECTION = utf8_unicode_ci, COLLATION_DATABASE = utf8_unicode_ci, COLLATION_SERVER = utf8_unicode_ci',
            ],
        ],
        'slaves' => [],
    ],
];

$config[PropelConstants::PROPEL] = [
    'database' => [
        'connections' => [],
    ],
    'runtime' => [
        'defaultConnection' => 'default',
        'connections' => ['default', 'zed'],
    ],
    'generator' => [
        'defaultConnection' => 'default',
        'connections' => ['default', 'zed'],
        'objectModel' => [
            'defaultKeyType' => 'fieldName',
            'builders' => [
                'object' => '\Spryker\Zed\PropelOrm\Business\Builder\ObjectBuilder',
                'query' => '\Spryker\Zed\PropelOrm\Business\Builder\QueryBuilder',
            ],
        ],
    ],
    'paths' => [
        'phpDir' => APPLICATION_ROOT_DIR,
        'sqlDir' => APPLICATION_ROOT_DIR . '/src/Orm/Propel/' . APPLICATION_CODE_BUCKET . '/Sql/',
        'migrationDir' => APPLICATION_ROOT_DIR . '/src/Orm/Propel/' . APPLICATION_CODE_BUCKET . '/Migration_' . $config[PropelConstants::ZED_DB_ENGINE] . '/',
        'schemaDir' => APPLICATION_ROOT_DIR . '/src/Orm/Propel/' . APPLICATION_CODE_BUCKET . '/Schema/',
        'phpConfDir' => APPLICATION_ROOT_DIR . '/src/Orm/Propel/' . APPLICATION_CODE_BUCKET . '/Config/' . APPLICATION_ENV . '/',
        'loaderScriptDir' => APPLICATION_ROOT_DIR . '/src/Orm/Propel/generated-conf/',
    ],
];

$engine = $config[PropelConstants::ZED_DB_ENGINE];
$config[PropelConstants::PROPEL]['database']['connections']['default'] = $connections[$engine];
$config[PropelConstants::PROPEL]['database']['connections']['zed'] = $connections[$engine];
