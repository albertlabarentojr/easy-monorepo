<?php

declare(strict_types=1);

namespace EonX\EasyErrorHandler\Tests\Stubs;

use Bugsnag\Client;
use Bugsnag\Configuration;

final class BugsnagClientStub extends Client
{
    /**
     * @var mixed[]
     */
    private $calls = [];

    public function __construct()
    {
        parent::__construct(new Configuration('my-api-key'));
    }

    /**
     * @return mixed[]
     */
    public function getCalls(): array
    {
        return $this->calls;
    }

    public function notifyException($throwable, ?callable $callback = null): void
    {
        $this->calls[] = [$throwable, $callback];
    }
}
