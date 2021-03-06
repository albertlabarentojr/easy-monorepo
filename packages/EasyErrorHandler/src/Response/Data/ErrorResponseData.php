<?php

declare(strict_types=1);

namespace EonX\EasyErrorHandler\Response\Data;

use EonX\EasyErrorHandler\Interfaces\ErrorResponseDataInterface;

final class ErrorResponseData implements ErrorResponseDataInterface
{
    /**
     * @var mixed[]
     */
    private $headers;

    /**
     * @var mixed[]
     */
    private $rawData;

    /**
     * @var int
     */
    private $statusCode;

    /**
     * @param mixed[] $rawData
     * @param null|mixed[] $headers
     */
    public function __construct(array $rawData, ?int $statusCode = null, ?array $headers = null)
    {
        $this->rawData = $rawData;
        $this->statusCode = $statusCode ?? 500;
        $this->headers = $headers ?? [];
    }

    /**
     * @param mixed[] $rawData
     * @param null|mixed[] $headers
     */
    public static function create(array $rawData, ?int $statusCode = null, ?array $headers = null): self
    {
        return new self($rawData, $statusCode, $headers);
    }

    /**
     * @return mixed[]
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @return mixed[]
     */
    public function getRawData(): array
    {
        return $this->rawData;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
