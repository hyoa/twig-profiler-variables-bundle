<?php

namespace Hyoa\TwigProfilerVariablesBundle\DataCollector;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

class VariablesCollector extends DataCollector
{
    protected $serializer;

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
        $template = [];
        $template['name'] = $name;

        foreach ($variables as $key => $variable) {
            try {
                \Opis\Closure\serialize($variable);
                $template['variables'][$key] = $variable;
            } catch (\Exception $e) {
                continue;
            }
        }

        $this->data['templates'][] = $template;
    }

    /**
     * @return array
     */
    public function getTemplates()
    {
        return $this->data['templates'];
    }

    public function serialize()
    {
        return \Opis\Closure\serialize($this->data['templates']);
    }

    public function unserialize($data)
    {
        $this->data['templates'] = \Opis\Closure\unserialize($data);
    }
}
