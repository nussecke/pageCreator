<?php
namespace PageCreator;

use PageCreator\Mapper\PageCreator as MapperPageCreator;
use PageCreator\Entity\PageCreator as EntityPageCreator;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                /*
                'AllcopOrderManagement\Form\OrderManagement\OrderManagement' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $form = new \AllcopOrderManagement\Form\OrderManagement\OrderManagement($dbAdapter);

                    return $form;
                },
                */
                'PageCreator\Mapper\PageCreator' => function ($sm) {
                    $tableGateway = $sm->get('PageCreatorMapperGateway');
                    $table = new MapperPageCreator($tableGateway);
                    return $table;
                },
                'PageCreatorMapperGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new EntityPageCreator());
                    return new TableGateway('pagecreator', $dbAdapter, null, $resultSetPrototype);
                }
            )
        );
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
}
