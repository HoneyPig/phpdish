<?php

namespace PHPDish\DiscuzMigrationPlugin\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class PHPDishDiscuzMigrationExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

    }

    /**
     * {@inheritdoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $container->getExtensionConfig($this->getAlias()));

        //注册doctrine connection
        $container->prependExtensionConfig('doctrine', [
            'dbal' => [
                'connections' => [
                    '_discuz' => [
                        'dbname' => $config['database']['name'],
                        'host' => $config['database']['host'],
                        'port' => $config['database']['port'] ?? null,
                        'user' => $config['database']['user'],
                        'password' => $config['database']['password'],
                        'charset' => $config['database']['charset'] ?? 'UTF8',
                    ]
                ]
            ]
        ]);
    }


    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return 'phpdish_discuz';
    }
}
