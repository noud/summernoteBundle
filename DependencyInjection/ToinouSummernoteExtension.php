<?php

namespace Toinou\SummernoteBundle\DependencyInjection;

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
class ToinouSummernoteExtension extends Extension implements PrependExtensionInterface
{
    /**
     * @var string
     */
    protected $formTypeTemplate = 'ToinouSummernoteBundle:Form:summernoteField.html.twig';

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        $container->setParameter($this->getAlias().'.widget.config', $config);
    }

    /**
     * {@inheritDoc}
     */
    public function prepend(ContainerBuilder $container) {
        $configs = $container->getExtensionConfig($this->getAlias());
        $this->processConfiguration(new Configuration(), $configs);
        $this->configureTwigBundle($container);
    }

    protected function configureTwigBundle(ContainerBuilder $container) {
        foreach (array_keys($container->getExtensions()) as $name) {
            switch ($name) {
                case 'twig':
                    $twig = array('form_themes' => array($this->formTypeTemplate));
                    
                    $container->prependExtensionConfig(
                        $name,
                        $twig
                    );

                    break;
            }
        }
    }
}
