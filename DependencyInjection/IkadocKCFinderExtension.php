<?php

namespace Ikadoc\KCFinderBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class IkadocKCFinderExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
	    $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

	    $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

	    $container->setParameter('ikadoc_kc_finder_path',$config['base_path']);
	    $container->setParameter('ikadoc_kc_finder_config',$config['config']);
    }
}
