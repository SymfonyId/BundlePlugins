<?php

namespace Symfonian\Indonesia\BundlePlugins\Tests;

use Symfonian\Indonesia\BundlePlugins\BundleWithPlugins;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;

class DemoBundle extends BundleWithPlugins
{
    public function getAlias()
    {
        return 'demo';
    }

    protected function defaultPlugins()
    {
        return array(new CorePlugin());
    }
}
