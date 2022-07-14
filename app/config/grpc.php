<?php

declare(strict_types=1);

return [
    /**
     * Path to protoc-gen-php-grpc library.
     */
    'binaryPath' => __DIR__ . '/../../protoc-gen-php-grpc',
    'services' => [
        __DIR__ . '/../../proto/service.proto',
    ],
];
