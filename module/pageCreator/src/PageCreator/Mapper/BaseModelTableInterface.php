<?php
/**
 * BaseModelTableInterface
 *
 * Standard CRUD-Methods for a basic model.
 * Implementing this interface standardizes
 * access to CRUD-Methods and furthermore
 * ensures that RESTful controllers work properly.
 *
 */
namespace PageCreator\Mapper;

interface BaseModelTableInterface
{
    /**
     * Get all data
     *
     * @return Array with all data
     */
    public function fetchAll();

    /**
     * Get dataset by id
     *
     * @param Int $id
     * @return Array with searched dataset
     */
    public function get($id);

    /**
     * Create or Update a dataset
     *
     * @param Object $data
     * @return (Int) id of the created dateset
     */
    public function create($data);

    /**
     * Delete a dataset
     *
     * @param Int $id
     * @return (Int) id of the deleted dataset
     */
    public function delete($id);

}
