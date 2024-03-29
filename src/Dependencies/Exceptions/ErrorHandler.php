<?php

declare(strict_types=1);

namespace App\Dependencies\Exceptions;

use Psr\Log\LoggerInterface;

class ErrorHandler
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(\DomainException $e): void
    {
        $this->logger->warning($e->getMessage(), ['exception' => $e]);
    }
}