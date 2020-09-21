<?php

declare(strict_types=1);

namespace EonX\EasyDecision;

use EonX\EasyDecision\Interfaces\DecisionAggregatorInterface;
use EonX\EasyDecision\Interfaces\DecisionInterface;

final class DecisionAggregator implements DecisionAggregatorInterface
{
    /**
     * @var mixed[]
     */
    private $configurators = [];

    /**
     * @var \EonX\EasyDecision\Interfaces\DecisionInterface[]
     */
    private $decisions = [];

    public function addDecision(DecisionInterface $decision, array $configurators): DecisionAggregatorInterface
    {
        $this->decisions[] = $decision;
        $this->addConfigurator($decision, $configurators);

        return $this;
    }

    public function getConfiguratorsByDecision(DecisionInterface $decision): array
    {
        return $this->configurators[\spl_object_hash($decision)] ?? [];
    }

    public function getDecisions(): array
    {
        return $this->decisions;
    }

    /**
     * @param \EonX\EasyDecision\Interfaces\DecisionConfiguratorInterface[] $configurators
     */
    private function addConfigurator(DecisionInterface $decision, array $configurators): void
    {
        $this->configurators[\spl_object_hash($decision)] = $configurators;
    }
}