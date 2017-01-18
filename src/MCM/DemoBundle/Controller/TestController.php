<?php

namespace MCM\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller
{
    public function testAction($testVariable)
    {
        return $this->render('MCMDemoBundle:Test:test.html.twig', array('testVariable' => $testVariable));
    }
}
