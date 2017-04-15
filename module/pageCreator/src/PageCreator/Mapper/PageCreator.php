<?php

namespace PageCreator\Mapper;

use PageCreator\Mapper\BaseModelTableInterface;

use Zend\Db\TableGateway\TableGateway;

class PageCreator implements BaseModelTableInterface
{

    /**
     * @const String Database Primary Key
     */
    const DATABASE_PK = 'testid';

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     * Get all data
     *
     * @return Array with all data
     */
    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet->buffer();
    }

    /**
     * Get dataset by id
     *
     * @param Int $id
     * @throws \Exception
     * @return Array with searched dataset
     */
    public function get($id)
    {
        $id = (int)$id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    /**
     * Create or Update a dataset
     *
     * @param Object $data
     * @throws \Exception
     * @return void (Int) id of the created dateset
     */
    public function create($data)
    {
        $data = array(
            'title' => $data->title,
            'active' => $data->active,
        );

        $id = (int)$data->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->get($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Page id does not exist');
            }
        }
    }

    /**
     * Delete a dataset
     *
     * @param Int $id
     * @return void (Int) id of the deleted dataset
     */
    public function delete($id)
    {
        $this->tableGateway->delete(array('id' => (int)$id));
    }

//
//    /**
//     * @const String Database Primary Key
//     */
//    const DATABASE_PK = 'basketheaderid';
//
//    /**
//     * @var Zend\Db\TableGateway\TableGateway
//     */
//    protected $tableGateway;
//
//    /**
//     * Constructor
//     *
//     * @param TableGateway $tableGateway
//     */
//    public function __construct(TableGateway $tableGateway)
//    {
//        $this->tableGateway = $tableGateway;
//    }
//
//
//    /**
//     * Create or Update a dataset
//     *
//     * @param Object $basketheaderid
//     * @param $username
//     * @internal param Object $data
//     * @return void (Int) id of the created dateset
//     */
//    public function createBasketLog($basketheaderid, $username)
//    {
//        $username = "(BO) " . $username;
//
//        $now = date("Y-m-d H:i:s");
//        $cancelCode = 152;
//        $sqlSelect = "INSERT INTO basketlog (basketheaderid, creationdate, createdby, code, hint) ";
//        $sqlSelect .= "VALUES(${basketheaderid}, '${now}', '${username}', ${cancelCode}, NULL)";
//
//        $resultSet = $this->tableGateway->getAdapter()->query($sqlSelect)->execute();
//
//        return $resultSet;
//    }
//
//    /**
//     * Delete a dataset
//     *
//     * @param Int $id
//     * @return void (Int) id of the deleted dataset
//     */
//    public function delete($id)
//    {
//        // TODO: Implement delete() method.
//    }
//
//    /**
//     * Get all data
//     *
//     * @return Array with all data
//     */
//    public function fetchAll()
//    {
//
//    }
//
//    /**
//     * Get dataset by id
//     *
//     * @param Int $basketheaderid
//     * @throws \Exception
//     * @return Array with searched dataset
//     */
//    public function get($basketheaderid)
//    {
//        $sqlSelect = "SELECT bh.basketheaderid, bh.portalid, bh.orderid, bh.transmitted,  bh.total, bh.paymentcode, bl.code,  ";
//        $sqlSelect .= "c.firstname, c.lastname, c.company, c.email, c.title, c.street, c.zip, c.city ";
//        $sqlSelect .= "FROM basketheader bh ";
//        $sqlSelect .= "JOIN customer c ON c.customerid = bh.customerid ";
//        $sqlSelect .= "JOIN basketlog bl ON bl.basketlogid = (Select MAX(basketlogid) from basketlog where basketheaderid = bh.basketheaderid) ";
//        $sqlSelect .= "WHERE bh.basketheaderid = ${basketheaderid}";
//
//        $rowset = $this->tableGateway->getAdapter()->query($sqlSelect)->execute();
//
//        $row = $rowset->current();
//
//        if(!$row) {
//            throw new \Exception("Basket #$basketheaderid not found");
//        }
//
//        return $row;
//    }
//
//    /**
//     * Get dataset by id
//     *
//     * @param Int $basketheaderid
//     * @throws \Exception
//     * @return Array with searched dataset
//     */
//    public function getLastCode($basketheaderid)
//    {
//        $sqlSelect = "SELECT code FROM BasketLog b INNER JOIN (SELECT MAX(creationdate) AS MaxDateTime FROM BasketLog WHERE basketheaderid = ${basketheaderid}) bb ";
//        $sqlSelect .= "ON b.creationdate = bb.MaxDateTime ORDER BY b.creationdate DESC";
//
//        $rowset = $this->tableGateway->getAdapter()->query($sqlSelect)->execute();
//
//        $row = $rowset->current();
//
//        return $row['CODE'];
//    }
//
//    /**
//     * Get Code Description from basketcodlog table
//     *
//     * @param $code
//     * @return mixed
//     * @throws \Exception
//     */
//    public function getCodeDescriptionFrom($code) {
//        $sqlSelect = "SELECT de AS CODEDESCRIPTION FROM basketlogcode WHERE code = ${code}";
//
//        $resultSet = $this->tableGateway->getAdapter()->query($sqlSelect)->execute();
//
//        $row = $resultSet->current();
//
//        if(!$row) {
//            throw new \Exception("Code with #$code not found");
//        }
//
//        return $row['CODEDESCRIPTION'];
//    }
//
//    /**
//     * Get all basketitems from basketitem table
//     *
//     * @param $basketheaderid
//     * @return mixed
//     */
//    public function getBasketItemsByBasketheaderId($basketheaderid) {
//        $sqlSelect = "SELECT * FROM basketitem WHERE basketheaderid = ${basketheaderid}";
//
//        $resultSet = $this->tableGateway->getAdapter()->query($sqlSelect)->execute();
//
//        return $resultSet;
//    }
//
//    /**
//     * Get the basketlog history by basketheaderid.
//     *
//     * @param $basketheaderid
//     * @return mixed
//     */
//    public function getHistoryOfBasket($basketheaderid)
//    {
//        $sqlSelect = "SELECT bl.creationdate, blc.de, bl.code FROM basketlog bl JOIN basketlogcode blc ON bl.code = blc.code WHERE bl.basketheaderid = ${basketheaderid} ORDER BY bl.creationdate DESC";
//
//        $resultSet = $this->tableGateway->getAdapter()->query($sqlSelect)->execute();
//
//        return $resultSet;
//    }
//
//    /**
//     * @see \Core\Pagination\Interfaces\Model\Paginateable::fetchPaged()
//     */
//    public function fetchPaged($skip, $first, $id = null, $orderby = null, $order = null, $search = null)
//    {
//        $lastMonth = date("Ymd", strtotime("-1 month"));
//        $getCurrentDate = date("Ymd", time() + 86400);
//        $search = str_replace("'", '', $search);
//
//        // search for portals:
//        // 9244, 4034, 4033, 3078, 4031 3089, 4042, 7077, 9344, 9459, 9458, 9498, 121, 111, 3090, 4043, 9444, 5200
////        $sqlSelect = "SELECT SKIP {$skip} FIRST {$first} ";
////        $sqlSelect .= "bh.basketheaderid, bh.portalid, bh.orderid, bh.transmitted, c.firstname, c.lastname,c.company,
////c.email, bh.total, bh.paymentcode FROM basketheader bh, customer c WHERE c.customerid = bh.customerid ";
////        $sqlSelect .= "AND (bh.portalid in (9244,4034,4033,3078,4031,3089,4042,7077,9344,9459,9458,9498,121,11,3090,4043,9444,5200)) ";
////        $sqlSelect .= "AND bh.transmitted > '{$lastMonth}' ";
////        $sqlSelect .= "AND bh.transmitted < '{$getCurrentDate}' ";
////
////        if ($search != null) {
////            if (preg_match('/^[0-9]+/', $search)) {
////                $sqlSelect .= " AND bh.orderid = '${search}' ";
////            } else {
////                $search = strtolower($search);
////                $sqlSelect .= "AND (LOWER( c.firstname ) LIKE '%${search}%' OR LOWER( c.lastname ) LIKE '%${search}%' OR LOWER( c.email ) LIKE '%${search}%') ";
////            }
////        }
////
////        if ($orderby != null && $order != null) {
////            if ($orderby == 'bh.transmitted' || $orderby == 'bh.orderid') {
////                $sqlSelect .= " ORDER BY LOWER(${orderby}) ${order}";
////            } else {
////                $sqlSelect .= " ORDER BY ${orderby} ${order}";
////            }
////        } else {
////            $sqlSelect .= " ORDER BY bh.transmitted DESC";
////        }
//
//        $sqlSelect = "SELECT SKIP {$skip} FIRST {$first} ";
//        $sqlSelect .= "bh.basketheaderid, bh.portalid, bh.orderid, bh.transmitted, c.firstname, c.lastname,";
//        $sqlSelect .= "c.company, c.email, bh.total, bh.paymentcode ";
//        $sqlSelect .= "FROM basketheader bh ";
//        $sqlSelect .= "JOIN customer c ON c.customerid = bh.customerid ";
//        $sqlSelect .= "WHERE (bh.portalid = 9244 OR bh.portalid = 4034 OR bh.portalid = 4033 OR bh.portalid = 3091 OR bh.portalid = 7000 OR bh.portalid = 3304 OR bh.portalid = 3305 OR bh.portalid = 3300 OR bh.portalid = 3301) ";
//        $sqlSelect .= "AND bh.transmitted > '{$lastMonth}' ";
//        $sqlSelect .= "AND bh.transmitted < '{$getCurrentDate}' ";
//
//        if ($search != null) {
//            if (preg_match('/^[0-9]+/', $search)) {
//                $sqlSelect .= " AND bh.orderid = '${search}'";
//            } else {
//                $search = strtolower($search);
//                $sqlSelect .= " AND LOWER(NVL(c.firstname, \"\") || \" \" || NVL(c.lastname, \"\") || \" \" || NVL(c.email,\"\")) LIKE '%${search}%'";
//            }
//        }
//
//        if ($orderby != null && $order != null) {
//            if ($orderby == 'bh.transmitted' || $orderby == 'bh.orderid') {
//                $sqlSelect .= " ORDER BY LOWER(${orderby}) ${order}";
//            } else {
//                $sqlSelect .= " ORDER BY ${orderby} ${order}";
//            }
//        } else {
//            $sqlSelect .= " ORDER BY bh.transmitted DESC";
//        }
//
//        $resultSet = $this->tableGateway->getAdapter()->query($sqlSelect)->execute();
//
//        return $resultSet;
//    }
//
//
//    /**
//     * Get the total count of
//     * existing rows.
//     *
//     * @param null $id
//     * @param null $search
//     * @return int
//     */
//    public function getTotalCount($id = null, $search = null)
//    {
//        $lastMonth = date("Ymd",strtotime("-1 month"));
//        $getCurrentDate = date("Ymd", time() + 86400);
//        $search = str_replace("'", '', $search);
////
////        // search for portals:
////        // 9244, 4034, 4033, 3078, 4031 3089, 4042, 7077, 9344, 9459, 9458, 9498, 121, 111, 3090, 4043, 9444, 5200
////        $sqlSelect = "SELECT COUNT(*) as total FROM basketheader bh, customer c ";
////        $sqlSelect .= "WHERE bh.customerid = c.customerid ";
////        $sqlSelect .= "AND bh.portalid in (9244,4034,4033,3078,4031,3089,4042,7077,9344,9459,9458,9498,121,11,3090,4043,9444,5200) ";
////        $sqlSelect .= "AND bh.transmitted > '{$lastMonth}' ";
////        $sqlSelect .= "AND bh.transmitted < '{$getCurrentDate}' ";
////
////        if ($search != null) {
////            if (preg_match('/^[0-9]+/', $search)) {
////                $sqlSelect .= "AND bh.orderid = '${search}' ";
////            } else {
////                $search = strtolower($search);
////                $sqlSelect .= "AND (LOWER( c.firstname ) LIKE '%${search}%' OR LOWER( c.lastname ) LIKE '%${search}%' OR LOWER( c.email ) LIKE '%${search}%') ";
////            }
////        }
//
//        $sqlSelect = "SELECT COUNT(*) AS total FROM basketheader bh ";
//        $sqlSelect .= "JOIN customer c ON c.customerid = bh.customerid ";
//        $sqlSelect .= "WHERE (bh.portalid = 9244 OR bh.portalid = 4034 OR bh.portalid = 4033 OR bh.portalid = 3091 OR bh.portalid = 7000OR bh.portalid = 3304 OR bh.portalid = 3305 OR bh.portalid = 3300 OR bh.portalid = 3301) ";
//        $sqlSelect .= "AND bh.transmitted > '{$lastMonth}' ";
//        $sqlSelect .= "AND bh.transmitted < '{$getCurrentDate}' ";
//
//        if ($search != null) {
//            if (preg_match('/^[0-9]+/', $search)) {
//                $sqlSelect .= "AND bh.orderid = '${search}' ";
//            } else {
//                $search = strtolower($search);
//                $sqlSelect .= "AND LOWER(NVL(c.firstname, \"\") || \" \" || NVL(c.lastname, \"\") || \" \" || NVL(c.email,\"\")) LIKE '%${search}%'";
//            }
//        }
//
//        $resultSet = $this->tableGateway->getAdapter()->query($sqlSelect)->execute();
//
//        $current = $resultSet->current();
//        return $current['TOTAL'];
//    }
//
//    /**
//     * Create or Update a dataset
//     *
//     * @param Object $data
//     * @return (Int) id of the created dateset
//     */
//    public function create($data)
//    {
//        // TODO: Implement create() method.
//    }

}