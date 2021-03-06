<?php

/**
 * Data Access Object (DAO) for messages.
 *  Performs operations on database.
 * @author Madhouse
 * @package Madhouse_HelloWorld
 * @subpackage Model
 * @since 1.00
 */
class Madhouse_HelloWorld_Models_Message extends DAO
{

    function __construct()
    {
        parent::__construct();
        $this->setTableName('t_mdh_helloworld_message');
        $this->setPrimaryKey('pk_i_id');
        $this->setFields(array('pk_i_id', 's_content'));
    }

    /**
     * Singleton.
     */
    private static $instance;

    /**
     * Singleton constructor.
     * @return an MadhouseMessengerDAO object.
     */
    public static function newInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * {@inheritDoc}
     */
    public function listAll($page = null, $length = null)
    {
        $this->dao->select($this->getFields());
        $this->dao->from($this->getTableName());

        if (!is_null($page) && !is_null($length)) {
            $this->dao->limit($page - 1, $length);
        }

        $result = $this->dao->get();
        if($result == false) {
            return array();
        }

        return $result->result();
    }
}
