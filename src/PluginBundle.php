<?php

namespace Symfonian\Indonesia\BundlePlugins;

use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Extend your bundle from this class. It allows users to register plugins for this bundle by providing them as
 * constructor arguments.
 *
 * The bundle itself can have no container extension or configuration anymore. Instead, you can introduce something
 * like a `CorePlugin`, which is registered as a `PluginInterface` for this bundle. Return an instance of it from your
 * bundle's `defaultPlugins()` method.
 */
abstract class PluginBundle extends Bundle
{
    /**
     * @var PluginInterface[]
     */
    private $registeredPlugins = array();

    abstract public function getAlias();

    public function addConfiguration(NodeDefinition $rootNode)
    {
    }

    public function addCompilerPass(ContainerBuilder $container)
    {
    }

    public function load(array $config, ContainerBuilder $container)
    {
    }

    final public function __construct(array $plugins = array())
    {
        foreach ($this->defaultPlugins() as $plugin) {
            $this->registerPlugin($plugin);
        }

        foreach ($plugins as $plugin) {
            $this->registerPlugin($plugin);
        }
    }

    /**
     * @inheritdoc
     */
    final public function build(ContainerBuilder $container)
    {
        $this->addCompilerPass($container);
        foreach ($this->registeredPlugins as $plugin) {
            $plugin->build($container);
        }
    }

    /**
     * @inheritdoc
     */
    final public function boot()
    {
        foreach ($this->registeredPlugins as $plugin) {
            $plugin->boot($this->container);
        }
    }

    /**
     * Provide any number of `PluginInterface`s that should always be registered.
     *
     * @return PluginInterface[]
     */
    protected function defaultPlugins()
    {
        return array();
    }

    /**
     * @inheritdoc
     */
    final public function getContainerExtension()
    {
        return new PluginExtension($this);
    }

    /**
     * Register a plugin for this bundle.
     *
     * @param PluginInterface $plugin
     */
    private function registerPlugin(PluginInterface $plugin)
    {
        $this->registeredPlugins[] = $plugin;
    }

    public function getPlugins()
    {
        return $this->registeredPlugins;
    }
}
