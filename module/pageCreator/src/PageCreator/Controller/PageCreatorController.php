<?php

namespace PageCreator\Controller;

//use PageCreator\Entity\PageCreator as EntityPageCreator;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PageCreatorController extends AbstractActionController
{

    /**
     * @var \PageCreator\Mapper;
     */
    protected $pageCreatorMapper;


    /**
     * Action index
     *
     * @return array|string
     */
    public function indexAction()
    {
        $view = new ViewModel();

        $view->setVariables(array());

        return $view;
    }

    /**
     * Get the PageCreator Mapper
     *
     * @return \PageCreator\Mapper|null
     */
    public
    function getPageCreatorMapper()
    {
        if (!$this->pageCreatorMapper) {
            $sm = $this->getServiceLocator();
            $this->pageCreatorMapper = $sm->get('PageCreator\Mapper');
        }
        return $this->pageCreatorMapper;
    }

}