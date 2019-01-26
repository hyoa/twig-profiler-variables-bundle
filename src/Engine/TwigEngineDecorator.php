<?php

namespace Hyoa\TwigProfilerVariablesBundle\Engine;


use Hyoa\TwigProfilerVariablesBundle\DataCollector\VariablesCollector;
use Symfony\Bridge\Twig\TwigEngine;
use Symfony\Bundle\FrameworkBundle\Templating\TemplateNameParser;
use Twig\Environment;

class TwigEngineDecorator extends TwigEngine
{
    protected $environment;
    protected $collector;

    /**
     * TwigEngineDecorator constructor.
     * @param Environment $environment
     * @param TemplateNameParser $templateNameParser
     * @param VariablesCollector $collector
     */
    public function __construct(Environment $environment, TemplateNameParser $templateNameParser, VariablesCollector $collector)
    {
        parent::__construct($environment, $templateNameParser);
        $this->environment = $environment;
        $this->collector = $collector;
    }

    /**
     * @param $name
     * @param array $parameters
     * @return false|string
     * @throws \Twig\Error\Error
     */
    public function render($name, array $parameters = array())
    {
        $this->collector->collectTemplateParameters($name, $parameters);
        return parent::render($name, $parameters);
    }
}
