<?php

/**
 * This file is part of Spiral package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App;

use Spiral\Bootloader as Framework;
use Spiral\DotEnv\Bootloader as DotEnv;
use Spiral\Cycle\Bootloader as CycleBridge;
use Spiral\Framework\Kernel;
use Spiral\Prototype\Bootloader as Prototype;
use Spiral\RoadRunnerBridge\Bootloader as RoadRunnerBridge;

class App extends Kernel
{
    /*
     * List of components and extensions to be automatically registered
     * within system container on application start.
     */
    protected const LOAD = [
        // Environment configuration
        DotEnv\DotenvBootloader::class,

        // Core Services
        Framework\SnapshotsBootloader::class,
        Framework\Security\EncrypterBootloader::class,

        // Databases
        CycleBridge\DatabaseBootloader::class,
        CycleBridge\MigrationsBootloader::class,

        // ORM
        CycleBridge\SchemaBootloader::class,
        CycleBridge\CycleOrmBootloader::class,
        CycleBridge\AnnotatedBootloader::class,
        CycleBridge\CommandBootloader::class,

        // Dispatchers
        RoadRunnerBridge\GRPCBootloader::class,
        RoadRunnerBridge\QueueBootloader::class,

        // Framework commands
        Framework\CommandBootloader::class,
        CycleBridge\CommandBootloader::class,
        RoadRunnerBridge\CommandBootloader::class,

        // Debugging
        Framework\DebugBootloader::class,
        Framework\Debug\LogCollectorBootloader::class,
    ];

    /*
     * Application specific services and extensions.
     */
    protected const APP = [
        Prototype\PrototypeBootloader::class,
    ];
}
