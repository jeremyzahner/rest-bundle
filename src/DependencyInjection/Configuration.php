<?php

namespace Ibrows\RestBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 *
 * @codeCoverageIgnore
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ibrows_rest');

        $rootNode
            ->isRequired()
            ->children()
                ->arrayNode('resources')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('singular_name')->end()
                            ->scalarNode('plural_name')->end()
                            ->scalarNode('class')->end()
                            ->scalarNode('converter')->end()
                            ->scalarNode('identifier')
                                ->defaultValue('id')
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('caches')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('name')->end()
                            ->integerNode('max_age')->defaultValue(3600)->end()
                            ->enumNode('type')->values(array('private', 'public', 'nocache', 'nostore'))->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('exception_controller')
                    ->addDefaultsIfNotSet()
                    ->canBeEnabled()
                    ->children()
                        ->booleanNode('force_default')->defaultValue(false)->end()
                    ->end()
                ->end()
                ->arrayNode('param_converter')
                    ->isRequired()
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('common')
                            ->isRequired()
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->booleanNode('fail_on_validation_error')
                                    ->defaultTrue()
                                ->end()
                                ->scalarNode('validation_errors_argument')
                                    ->isRequired()
                                    ->cannotBeEmpty()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('link')
                            ->addDefaultsIfNotSet()
                            ->canBeDisabled()
                            ->children()
                                ->booleanNode('fail_on_validation_error')->end()
                                ->scalarNode('validation_errors_argument')->end()
                            ->end()
                        ->end()
                        ->arrayNode('patch')
                            ->addDefaultsIfNotSet()
                            ->canBeDisabled()
                            ->children()
                                ->booleanNode('fail_on_validation_error')->end()
                                ->scalarNode('validation_errors_argument')->end()
                            ->end()
                        ->end()
                        ->arrayNode('request_body')
                            ->addDefaultsIfNotSet()
                            ->canBeDisabled()
                            ->children()
                                ->booleanNode('fail_on_validation_error')->end()
                                ->scalarNode('validation_errors_argument')->end()
                            ->end()
                        ->end()
                        ->arrayNode('unlink')
                            ->addDefaultsIfNotSet()
                            ->canBeDisabled()
                            ->children()
                                ->booleanNode('fail_on_validation_error')->end()
                                ->scalarNode('validation_errors_argument')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('listener')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('cache')
                            ->canBeEnabled()
                        ->end()
                        ->arrayNode('collection_decorator')
                            ->canBeEnabled()
                        ->end()
                        ->arrayNode('debug')
                            ->canBeEnabled()
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('key_name')
                                    ->defaultValue('_debug')
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('etag')
                            ->canBeEnabled()
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('hashing_algorithm')
                                    ->defaultValue('crc32')
                                    ->validate()
                                    ->ifNotInArray(hash_algos())
                                        ->thenInvalid(
                                            'Invalid hashing algorithm "%s". Use one of those: ' .
                                            implode(', ', hash_algos())
                                        )
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('exclusion_policy')
                            ->canBeEnabled()
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('param_name')
                                    ->defaultValue('expolicy')
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('if_none_match')
                            ->canBeEnabled()
                        ->end()
                        ->arrayNode('link_header')
                            ->canBeEnabled()
                        ->end()
                        ->arrayNode('location')
                            ->canBeEnabled()
                        ->end()
                        ->arrayNode('resource_deserialization')
                            ->canBeEnabled()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('decorator')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('paginated')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('page_parameter_name')
                                    ->defaultValue('page')
                                ->end()
                                ->scalarNode('limit_parameter_name')
                                    ->defaultValue('limit')
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('offset')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('offset_parameter_name')
                                    ->defaultValue('offset')
                                ->end()
                                ->scalarNode('limit_parameter_name')
                                    ->defaultValue('limit')
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('last_id')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('sort_by_parameter_name')
                                    ->defaultValue('sortBy')
                                ->end()
                                ->scalarNode('sort_direction_parameter_name')
                                    ->defaultValue('sortDir')
                                ->end()
                                ->scalarNode('offset_id_parameter_name')
                                ->defaultValue('offsetId')
                                ->end()
                                ->scalarNode('limit_parameter_name')
                                    ->defaultValue('limit')
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
