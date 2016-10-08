<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * db_jobs
 *
 * @ORM\Table(name="db_jobs")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\db_jobsRepository")
 */
class db_jobs
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
     * @var string
     *
     * @ORM\Column(name="db_name", type="string", length=255)
     */
    private $dbName;

    /**
     * @var string
     *
     * @ORM\Column(name="db_detail", type="text")
     */
    private $dbDetail;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deadline", type="datetimetz")
     */
    private $dbDeadline;

    /**
     * @var int
     *
     * @ORM\Column(name="db_employer_id", type="integer")
     */
    private $dbEmployerId = 0;


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
     * Set dbName
     *
     * @param string $dbName
     *
     * @return db_jobs
     */
    public function setDbName($dbName)
    {
        $this->dbName = $dbName;

        return $this;
    }

    /**
     * Get dbName
     *
     * @return string
     */
    public function getDbName()
    {
        return $this->dbName;
    }

    /**
     * Set dbDetail
     *
     * @param string $dbDetail
     *
     * @return db_jobs
     */
    public function setDbDetail($dbDetail)
    {
        $this->dbDetail = $dbDetail;

        return $this;
    }

    /**
     * Get dbDetail
     *
     * @return string
     */
    public function getDbDetail()
    {
        return $this->dbDetail;
    }

    /**
     * Set dbDeadline
     *
     * @param DateTime $dbDeadline
     *
     * @return db_jobs
     */
    public function setDbDeadline($dbDeadline)
    {
        $this->dbDeadline = $dbDeadline;

        return $this;
    }

    /**
     * Get dbDeadline
     *
     * @return \DateTime
     */
    public function getDbDeadline()
    {
        return $this->dbDeadline;
    }

    /**
     * Set dbEmployerId
     *
     * @param integer $dbEmployerId
     *
     * @return db_jobs
     */
    public function setDbEmployerId($dbEmployerId)
    {
        $this->dbEmployerId = $dbEmployerId;

        return $this;
    }

    /**
     * Get dbEmployerId
     *
     * @return int
     */
    public function getDbEmployerId()
    {
        return $this->dbEmployerId;
    }
}

