<?php

namespace Hyoa\TwigProfilerVariablesBundle\DataCollector;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

class VariablesCollector extends DataCollector
{
    public function __construct()
    {
        $this->data['templates'] = [];
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param \Exception|null $exception
     */
    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
    }

    /**
     * Reset the collector
     */
    public function reset()
    {
        $this->data['templates'] = [];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'twig_profiler_variables.collector';
    }

    /**
     * @param string $name
     * @param array $variables
     */
    public function collectTemplateParameters($name, $variables)
    {
        $this->data['templates'][] = [
            'name' => $name,
            'variables' => $variables,
        ];
    }

    /**
     * @return array
     */
    public function getTemplates()
    {
        return $this->data['templates'];
    }
}
