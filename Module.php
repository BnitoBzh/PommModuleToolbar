<?php

namespace PommModuleToolbar;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $app = $e->getApplication();
        $config = $e->getTarget()->getServiceManager()->get('Config');
    
        if (
            isset($config['zenddevelopertools']['profiler']['enabled'])
            && $config['zenddevelopertools']['profiler']['enabled']
        ) {
            $app->getServiceManager()->get('pomm.queries');
        }
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfiguration()
    {
        return array(
            'factories' => array(
                'pomm.queries' => new \PommModuleToolbar\Service\SQLLoggerCollectorFactory('pomm.default.queries'),
            ),
        );
    }
}
