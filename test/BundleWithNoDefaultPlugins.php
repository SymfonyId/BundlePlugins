<?php

namespace Symfonian\Indonesia\BundlePlugins\Tests;

use Symfonian\Indonesia\BundlePlugins\BundleWithPlugins;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;

class BundleWithNoDefaultPlugins extends BundleWithPlugins
{
    public function getAlias()
    {
        return 'bundle_with_no_default_plugins';
    }
}
