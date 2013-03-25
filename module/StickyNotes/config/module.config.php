<?php
namespace StickyNotes;
// module/StickyNotes/config/module.config.php:
return array(
        'controllers' => array(
                'invokables' => array(
                        'StickyNotes\Controller\StickyNotes' => 'StickyNotes\Controller\StickyNotesController',
                ),
        ),
        'router' => array(
                'routes' => array(
                        'stickynotes' => array(
                                'type' => 'segment',
                                'options' => array(
                                        'route' => '/stickynotes[/:action][/:id]',
                                        'constraints' => array(
                                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                'id' => '[0-9]+',
                                        ),
                                        'defaults' => array(
                                                'controller' => 'StickyNotes\Controller\StickyNotes',
                                                'action' => 'index',
                                        ),
                                ),
                        ),
                ),
        ),
        'view_manager' => array(
                'template_path_stack' => array(
                        'stickynotes' => __DIR__ . '/../view',
                ),
        ),
        'doctrine' => array(
                'driver' => array(
                        __NAMESPACE__ . '_driver' => array(
                                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                                'cache' => 'array',
                                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Model/Entity')
                        ),
                        'orm_default' => array(
                                'drivers' => array(
                                        __NAMESPACE__ . '\Model\Entity' => __NAMESPACE__ . '_driver'
                                )
                        )
                )
        )
);
