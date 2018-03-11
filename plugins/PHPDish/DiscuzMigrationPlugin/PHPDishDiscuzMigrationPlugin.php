<?php

namespace PHPDish\DiscuzMigrationPlugin;

use PHPDish\DiscuzMigrationPlugin\DependencyInjection\PHPDishDiscuzMigrationExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class PHPDishDiscuzMigrationPlugin extends Bundle
{
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
