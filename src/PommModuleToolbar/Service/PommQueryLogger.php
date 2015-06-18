<?php

namespace PommModuleToolbar\Service;

use Zend\ServiceManager\ServiceManager;

class PommQueryLogger
{
    protected $data = array();
    
    public function __construct(ServiceManager $serviceManager)
    {
        $this->data = [
            'time' => 0,
            'queries' => [],
            'exception' => null,
        ];
        
        $callable = [$this, 'execute'];
        $pomm = $serviceManager->get('PommProject\PommModule\Service\PommServiceFactory');
        
        foreach ($pomm->getSessionBuilders() as $name => $builder) {
            $pomm->addPostConfiguration($name, function($session) use ($callable) {
                $session
                ->getClientUsingPooler('listener', 'query')
                ->attachAction($callable)
                ;
            });
        }
    }
    
    public function execute($name, $data, \PommProject\Foundation\Session\Session $session)
    {
        switch ($name) {
            case 'query:post':
                $this->data['time'] += $data['time_ms'];
                $data += array_pop($this->data['queries']);
            case 'query:pre':
                $this->data['queries'][] = $data;
                break;
        }
    }
    
    public function getQueries() {
        return $this->data['queries'];
    }
    
    public function getException() {
        return $this->data['exception'];
    }
    
    public function getTime() {
        return $this->data['time'];
    }
    
    public function getData() {
        return $this->data;
    }
}
