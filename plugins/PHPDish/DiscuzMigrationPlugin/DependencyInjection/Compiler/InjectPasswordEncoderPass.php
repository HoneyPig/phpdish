<?php

namespace PHPDish\DiscuzMigrationPlugin\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class InjectPasswordEncoderPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('security.encoder_factory.generic')) {
            return;
        }

        //不启用discuz的不替换
        if ($container->getParameter('security.password_encoder_strength') !== 'discuz') {
            return;
        }

        $passwordFactory = $container->findDefinition('security.encoder_factory.generic');
        $encoderMap = $passwordFactory->getArgument(0);

        foreach ($encoderMap as $class => $encoder) {
            if (
                $class === 'FOS\UserBundle\Model\UserInterface'
                || is_subclass_of($class, 'FOS\UserBundle\Model\UserInterface')
            ) {
                $encoderMap[$class] = new Reference('phpdish.discuz.security.password_cncoder');
                break;
            }
        }
        $passwordFactory->replaceArgument(0, $encoderMap);
    }
}