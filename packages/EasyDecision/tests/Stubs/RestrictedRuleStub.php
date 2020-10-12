<?php

declare(strict_types=1);

namespace EonX\EasyDecision\Tests\Stubs;

use EonX\EasyDecision\Interfaces\DecisionInterface;
use EonX\EasyDecision\Interfaces\RestrictedRuleInterface;

final class RestrictedRuleStub extends RuleStub implements RestrictedRuleInterface
{
    /**
     * @var string
     */
    private $supportedDecision;

    public function __construct(
        string $name,
        string $supportedDecision,
        $output,
        ?bool $supports = null,
        ?int $priority = null
    ) {
        parent::__construct($name, $output, $supports, $priority);

        $this->supportedDecision = $supportedDecision;
    }

    public function supportsDecision(DecisionInterface $decision): bool
    {
        return $decision->getName() === $this->supportedDecision;
    }
}