<?php

declare(strict_types = 1);

use Spryker\Service\FlysystemAws3v3FileSystem\Plugin\Flysystem\Aws3v3FilesystemBuilderPlugin;
use Spryker\Shared\FileSystem\FileSystemConstants;

require 'common/config_oms-development.php';

// >>> FILESYSTEM
$config[FileSystemConstants::FILESYSTEM_SERVICE] = [
    'ssp-inquiry' => [
        'sprykerAdapterClass' => Aws3v3FilesystemBuilderPlugin::class,
        'key' => getenv('TEST_BUCKET_67_SSP_CLAIM_STORAGE_S3_KEY_ACTUAL') ?: '',
        'secret' => getenv('TEST_BUCKET_67_SSP_CLAIM_STORAGE_S3_SECRET_ACTUAL') ?: '',
        'bucket' => 'test-bucket-9-ssp-claim-storage',
        'region' => getenv('AWS_REGION'),
        'version' => 'latest',
        'root' => '/ssp-inquiry',
        'path' => '',
    ],
    'ssp-files' => [
        'sprykerAdapterClass' => Aws3v3FilesystemBuilderPlugin::class,
        'key' => getenv('TEST_BUCKET_67_SSP_FILES_STORAGE_S3_KEY_ACTUAL') ?: '',
        'secret' => getenv('TEST_BUCKET_67_SSP_FILES_STORAGE_S3_SECRET_ACTUAL') ?: '',
        'bucket' => 'test-bucket-9-ssp-files-storage',
        'region' => getenv('AWS_REGION'),
        'version' => 'latest',
        'root' => '/files',
        'path' => '',
    ],
    'ssp-asset-image' => [
        'sprykerAdapterClass' => Aws3v3FilesystemBuilderPlugin::class,
        'key' => getenv('TEST_BUCKET_67_SSP_ASSETS_STORAGE_S3_KEY_ACTUAL') ?: '',
        'secret' => getenv('TEST_BUCKET_67_SSP_ASSETS_STORAGE_S3_SECRET_ACTUAL') ?: '',
        'bucket' => 'test-bucket-9-ssp-assets-storage',
        'region' => getenv('AWS_REGION'),
        'version' => 'latest',
        'root' => '/ssp-asset-image',
        'path' => '',
    ],
];
