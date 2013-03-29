<?php

/**
 * Description of Module
 *
 * @author Arian Khosravi <arian@bigemployee.com>, <@ArianKhosravi>
 */

namespace Core;

use Zend\ModuleManager\ModuleManager;

class Module {
    
    public function init(ModuleManager $moduleManager)
    {
        /*On controller event dispatch assign request and response parameters */
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
        $sharedEvents->attach(__NAMESPACE__, 'dispatch', function($event) {
              $controller = $event->getTarget();
              $controller->request = $event->getRequest();
              $controller->response = $event->getResponse();
        });
    }
    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig() {
       /*  return array(
            'factories' => array(
                'StickyNotes\Model\StickyNotesTable' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new Model\StickyNotesTable($dbAdapter);
                    return $table;
                },
            ),
        ); */
    }

}
