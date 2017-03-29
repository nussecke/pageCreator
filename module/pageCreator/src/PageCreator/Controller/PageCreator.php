<?php
/**
 * Controller OrderManagement
 *
 * The OrderMangementController covers several base actions
 * executed for actions with order management.
 *
 * @package OrderMangement
 * @author  Christian Durak <durak@allcop.de>
 */
namespace AllcopOrderManagement\Controller;

//use PageCreator\Entity\PageCreator as EntityPageCreator;

use Zend\View\Model\ViewModel;

class PageCreatorController
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