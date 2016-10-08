<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * db_comments
 *
 * @ORM\Table(name="db_comments")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\db_commentsRepository")
 */
class db_comments
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="db_user_id", type="integer")
     */
    private $dbUserId;

    /**
     * @var bool
     *
     * @ORM\Column(name="db_general", type="boolean")
     */
    private $dbGeneral;

    /**
     * @var string
     *
     * @ORM\Column(name="db_text", type="string", length=255)
     */
    private $dbText;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
 
    /**
     * Set dbUserId
     *
     * @param integer $dbUserId
     *
     * @return db_comments
     */
    public function setDbUserId($dbUserId)
    {
        $this->dbUserId = $dbUserId;

        return $this;
    }

    /**
     * Get dbUserId
     *
     * @return int
     */
    public function getDbUserId()
    {
        return $this->dbUserId;
    }

    /**
     * Set dbGeneral
     *
     * @param boolean $dbGeneral
     *
     * @return db_comments
     */
    public function setDbGeneral($dbGeneral)
    {
        $this->dbGeneral = $dbGeneral;

        return $this;
    }

    /**
     * Get dbGeneral
     *
     * @return bool
     */
    public function getDbGeneral()
    {
        return $this->dbGeneral;
    }

    /**
     * Set dbText
     *
     * @param string $dbText
     *
     * @return db_comments
     */
    public function setDbText($dbText)
    {
        $this->dbText = $dbText;

        return $this;
    }

    /**
     * Get dbText
     *
     * @return string
     */
    public function getDbText()
    {
        return $this->dbText;
    }
}

