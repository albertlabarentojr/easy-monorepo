<?php

declare(strict_types=1);

use EonX\EasyDecision\Bridge\Interfaces\TagsInterface;
use EonX\EasyDecision\Bridge\Symfony\DataCollector\DecisionDataCollector;
use EonX\EasyDecision\Configurators\AddRulesDecisionConfigurator;
use EonX\EasyDecision\Decisions\DecisionFactory;
use EonX\EasyDecision\Expressions\ExpressionLanguageFactory;
use EonX\EasyDecision\Expressions\Interfaces\ExpressionLanguageFactoryInterface;
use EonX\EasyDecision\Interfaces\DecisionFactoryInterface;
use EonX\EasyDecision\Interfaces\ExpressionLanguageRuleFactoryInterface;
use EonX\EasyDecision\Rules\ExpressionLanguageRuleFactory;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

use function Symfony\Component\DependencyInjection\Loader\Configurator\tagged_iterator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->defaults()
        ->autowire()
        ->autoconfigure();

    $services->set(AddRulesDecisionConfigurator::class)
        ->arg('$rules', tagged_iterator(TagsInterface::DECISION_RULE));

    $services->set(DecisionFactoryInterface::class, DecisionFactory::class)
        ->arg('$configurators', tagged_iterator('easy_decision.decision_configurator'));

    $services->set(ExpressionLanguageFactoryInterface::class, ExpressionLanguageFactory::class);

    $services->set(ExpressionLanguageRuleFactoryInterface::class, ExpressionLanguageRuleFactory::class);

    $services->set(DecisionDataCollector::class)
        ->tag('data_collector', [
            'template' => '@EasyDecision/Collector/decision_collector.html.twig',
            'id' => DecisionDataCollector::NAME,
        ]);
};
