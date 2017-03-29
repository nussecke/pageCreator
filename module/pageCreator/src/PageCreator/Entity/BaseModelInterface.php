<?php
/**
 * BaseModelInterface
 *
 * By implementing this basic model interface its ensured,
 * that models are holding obligatory methods for data exchange,
 * called 'Hydrators' by Zend Framework 2.
 *
 *
 */
namespace PageCreator\Entity;

interface BaseModelInterface
{
    /**
     * Copies the passed data to the
     * entity's properties.
     * 
     * This method is automatically called
     * by the Zend Framework 2.
     * 
     * @param array $data
     */
    public function exchangeArray($data);
    
    /**
     *  Hydrator used by the Zend Framework 2
     *  which is used for binding data to a form.
     */
    public function getArrayCopy();
    
}