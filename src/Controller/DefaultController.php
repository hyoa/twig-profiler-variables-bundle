<?php


namespace Hyoa\TwigProfilerVariablesBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Only used to test the DataCollector
 * Class DefaultController
 * @package Hyoa\TwigProfilerVariablesBundle\Controller
 */
class DefaultController extends AbstractController
{
    public function indexAction()
    {
        return $this->render(
            "@TwigProfilerVariables/Tests/index.html.twig",
            [
                "variable1" => 'a random string',
                "variable2" => [1, 2, 3, 4]
            ]
        );
    }
}
