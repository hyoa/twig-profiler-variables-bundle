<?php

namespace Hyoa\TwigProfilerVariablesBundle\Tests\Controller;

use Hyoa\TwigProfilerVariablesBundle\DataCollector\VariablesCollector;
use Hyoa\TwigProfilerVariablesBundle\Tests\DataCollectorTestKernel;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DataCollectorTest extends WebTestCase
{
    public function testDataCollector()
    {
        $kernel = new DataCollectorTestKernel();
        $kernel->boot();
        $client = new Client($kernel);
        $client->enableProfiler();
        $client->request('GET', '/test');

        /** @var VariablesCollector $collector */
        $collector = $client->getProfile()->getCollector('twig_profiler_variables.collector');

        // Testing the return of collector
        $this->assertInstanceOf(VariablesCollector::class, $collector, sprintf('DataCollector should be an instance of %s', VariablesCollector::class));
        $this->assertInternalType('array', $collector->getTemplates(), 'Result of getTemplates should be an array');
        $this->assertInternalType('array', $collector->getTemplates()[0], 'Each element of geTemplates should be an array');
        $this->assertArrayHasKey('name', $collector->getTemplates()[0], 'Each element should have the template name');
        $this->assertArrayHasKey('variables', $collector->getTemplates()[0], 'Each element should have variables injected by twig render function');

        // Testing the content of the first element
        $this->assertEquals('@TwigProfilerVariables/Tests/index.html.twig', $collector->getTemplates()[0]['name']);
        $this->assertEquals(2, count($collector->getTemplates()[0]['variables']));
        $this->assertArrayHasKey('variable1', $collector->getTemplates()[0]['variables']);
        $this->assertArrayHasKey('variable2', $collector->getTemplates()[0]['variables']);
        $this->assertEquals('a random string', $collector->getTemplates()[0]['variables']['variable1']);
        $this->assertEquals([1, 2, 3, 4], $collector->getTemplates()[0]['variables']['variable2']);
    }

    protected static function getKernelClass()
    {
        return DataCollectorTestKernel::class;
    }
}
