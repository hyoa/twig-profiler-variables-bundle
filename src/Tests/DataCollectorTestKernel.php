<?php

namespace Hyoa\TwigProfilerVariablesBundle\Tests;

use Hyoa\TwigProfilerVariablesBundle\TwigProfilerVariablesBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class DataCollectorTestKernel extends Kernel
{
    public function __construct()
    {
        parent::__construct('test', true);
    }

    public function registerBundles()
    {
        return [
            new FrameworkBundle(),
            new TwigProfilerVariablesBundle(),
            new TwigBundle()
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__ . '/config_test.yml');
    }
}
