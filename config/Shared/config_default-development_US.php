<?php

use Spryker\Shared\Application\ApplicationConstants;
use Spryker\Shared\Collector\CollectorConstants;
use Spryker\Shared\Mail\MailConstants;
use Spryker\Shared\Propel\PropelConstants;
use Spryker\Shared\Queue\QueueConstants;
use Spryker\Shared\RabbitMq\RabbitMqConstants;
use Spryker\Shared\Search\SearchConstants;

// ---------- Propel
$config[PropelConstants::ZED_DB_DATABASE] = 'US_development_zed';

// ---------- Email
$config[MailConstants::MAILCATCHER_GUI] = sprintf('http://%s:1080', $config[ApplicationConstants::HOST_ZED]);

// ---------- Elasticsearch
$ELASTICA_INDEX_NAME = 'us_search';
$config[SearchConstants::ELASTICA_PARAMETER__INDEX_NAME] = $ELASTICA_INDEX_NAME;
$config[CollectorConstants::ELASTICA_PARAMETER__INDEX_NAME] = $ELASTICA_INDEX_NAME;

// ---------- Queue
$config[QueueConstants::QUEUE_WORKER_INTERVAL_MILLISECONDS] = 1000;
$config[QueueConstants::QUEUE_WORKER_LOG_ACTIVE] = false;
$config[QueueConstants::QUEUE_WORKER_OUTPUT_FILE_NAME] = 'data/US/logs/ZED/queue.out';

// ---------- RabbitMQ
$config[RabbitMqConstants::RABBITMQ_CONNECTIONS] = [
    [
        RabbitMqConstants::RABBITMQ_DEFAULT_CONNECTION => true,
        RabbitMqConstants::RABBITMQ_CONNECTION_NAME => 'US-connection',
        RabbitMqConstants::RABBITMQ_HOST => 'localhost',
        RabbitMqConstants::RABBITMQ_PORT => '5672',
        RabbitMqConstants::RABBITMQ_PASSWORD => 'mate20mg',
        RabbitMqConstants::RABBITMQ_USERNAME => 'US_development',
        RabbitMqConstants::RABBITMQ_VIRTUAL_HOST => '/US_development_zed',
    ],
];

// ---------- MailCatcher
$config[MailConstants::MAILCATCHER_GUI] = sprintf('http://%s:1080', $config[ApplicationConstants::HOST_ZED]);
