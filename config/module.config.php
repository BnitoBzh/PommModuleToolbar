<?php 

return array(
     
    'service_manager' => array(
        'factories' => array(
            'pomm.queries' => 'PommModuleToolbar\Service\SQLLoggerCollectorFactory',
        ),
    ),
     
    'view_manager' => array(
        'template_map' => array(
            'zend-developer-tools/toolbar/pomm-queries'
            => __DIR__ . '/../view/zend-developer-tools/toolbar/pomm-queries.phtml',
        ),
    ),
     
    'zenddevelopertools' => array(
        'profiler' => array(
            'collectors' => array(
                'pomm.queries' => 'pomm.queries',
            ),
        ),
        'toolbar' => array(
            'entries' => array(
                'pomm.queries' => 'zend-developer-tools/toolbar/pomm-queries',
            ),
        ),
    ),
     
);

