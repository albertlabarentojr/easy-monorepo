<?php
declare(strict_types=1);

namespace StepTheFkUp\EasyRepository\Bridge\Laravel\Exceptions;

use Exception;
use StepTheFkUp\EasyRepository\Interfaces\EasyRepositoryExceptionInterface;

final class EmptyRepositoriesListException extends Exception implements EasyRepositoryExceptionInterface
{
    // No body needed.
}

\class_alias(
    EmptyRepositoriesListException::class,
    'LoyaltyCorp\EasyRepository\Bridge\Laravel\Exceptions\EmptyRepositoriesListException',
    false
);
