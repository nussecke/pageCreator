<?php

namespace PageCreator\Entity;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class PageCreator implements BaseModelInterface, InputFilterAwareInterface
{
    /**
     * @var int
     */
    public $id;
    public $title;


    protected $inputFilter;


    /**
     * @see \Core\Model\Interfaces\BaseModelInterface::exchangeArray()
     */
    public function exchangeArray($data)
    {
        $this->id     = (!empty($data['id'])) ? $data['id'] : null;
        $this->title = (!empty($data['title'])) ? $data['title'] : null;
    }

    /**
     *  Hydrator used by the Zend Framework 2
     *  which is used for binding data to a form.
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    /**
     * Set input filter
     *
     * @param  InputFilterInterface $inputFilter
     * @return InputFilterAwareInterface
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
    }

    /**
     * Retrieve input filter
     *
     * @return InputFilterInterface
     */
    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();

//            $inputFilter->add($factory->createInput(array(
//                'name' => 'test',
//                'required' => false,
//                'filters' => array(),
//            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}