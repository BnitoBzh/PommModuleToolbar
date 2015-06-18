<?php

namespace PommModuleToolbar\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use PommModuleToolbar\Collector\PommQueriesCollector;

class SQLLoggerCollectorFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $pommQueryLogger = new PommQueryLogger($serviceLocator);
        return new PommQueriesCollector($pommQueryLogger);
    }
}
