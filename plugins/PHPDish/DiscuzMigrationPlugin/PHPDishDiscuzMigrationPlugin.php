<?php

namespace PHPDish\DiscuzMigrationPlugin;

use PHPDish\DiscuzMigrationPlugin\DependencyInjection\Compiler\InjectPasswordEncoderPass;
use PHPDish\DiscuzMigrationPlugin\DependencyInjection\PHPDishDiscuzMigrationExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class PHPDishDiscuzMigrationPlugin extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new InjectPasswordEncoderPass());
    }

    /**
     * {@inheritdoc}
     */
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            return new PHPDishDiscuzMigrationExtension();
        }
        return $this->extension;
    }
}
