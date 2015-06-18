<?php

namespace PommModuleToolbar\Collector;
 
use ZendDeveloperTools\Collector\CollectorInterface;
use Zend\Mvc\MvcEvent;
use PommProject\Foundation\Session\Session;
use PommModuleToolbar\Service\PommQueryLogger;

class PommQueriesCollector implements CollectorInterface
{
    protected $queryLogger = null;
    
    public function __construct(PommQueryLogger $queryLogger)
    {
        $this->queryLogger = $queryLogger;
    }
    
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'pomm.queries';
    }
 
    /**
     * {@inheritDoc}
     */
    public function getPriority()
    {
        return PHP_INT_MAX;
    }
 
    /**
     * @inheritdoc
     */
    public function collect(MvcEvent $mvcEvent)
    {
        
    }
    
    public function getPommData()
    {
        return $this->queryLogger->getData();
    }
    
    public function getQueryCount() {
        return count($this->queryLogger->getQueries());
    }
    
    public function getTotalTime() {
        return $this->queryLogger->getTime()/1000;
    }
    
    public function getQueries() {
        return $this->queryLogger->getQueries();
    }
}