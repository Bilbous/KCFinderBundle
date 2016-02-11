<?php

namespace Ikadoc\KCFinderBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
	    $treeBuilder = $this->createTreeBuilder();
	    $treeBuilder
		    ->root('ikadoc_kc_finder')
            ->children()
	            ->scalarNode('base_path')
		            ->isRequired()
		            ->cannotBeEmpty()
		        ->end()
	            ->append($this->createConfigsNode())
            ->end()
        ;

        return $treeBuilder;
    }



	/**
	 * Creates the configs node.
	 *
	 * @return \Symfony\Component\Config\Definition\Builder\NodeDefinition The configs node.
	 */
	private function createConfigsNode()
	{
		return $this->createNode('config')
			->useAttributeAsKey('name')
			->prototype('variable')
			->end();
	}

	/**
	 * Creates a node.
	 *
	 * @param string $name The node name.
	 *
	 * @return \Symfony\Component\Config\Definition\Builder\NodeDefinition The node.
	 */
	private function createNode($name)
	{
		return $this->createTreeBuilder()->root($name);
	}

	/**
	 * Creates a tree builder.
	 *
	 * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder.
	 */
	private function createTreeBuilder()
	{
		return new TreeBuilder();
	}
}
