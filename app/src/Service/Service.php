<?php

/**
 * This file is part of Spiral package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Service;

use App\Job\Ping;
use Spiral\Core\Container\SingletonInterface;
use Spiral\RoadRunner\GRPC;
use Spiral\Queue\QueueInterface;

class Service implements ServiceInterface, SingletonInterface
{
    public function __construct(
        private QueueInterface $queue
    ) {
    }

    public function Welcome(GRPC\ContextInterface $ctx, Message\Message $in): Message\Message
    {
        $out = new Message\Message();
        $out->setMsg('Hello, ' . $in->getMsg());

        return $out;
    }

    public function Schedule(GRPC\ContextInterface $ctx, Message\Job $in): Message\JobID
    {
        $id = $this->queue->push(Ping::class, ['value' => $in->getValue()]);

        $out = new Message\JobID();
        $out->setId($id);

        return $out;
    }
}
