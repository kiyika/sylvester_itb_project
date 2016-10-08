<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * db_users
 *
 * @ORM\Table(name="db_users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\db_usersRepository")
 */
class db_users
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
     * @ORM\Column(name="db_email", type="string", length=255)
     */
    private $dbEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="db_password", type="string", length=255)
     */
    private $dbPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="db_contact", type="string", length=255)
     */
    private $dbContact;

    /**
     * @var string
     *
     * @ORM\Column(name="db_image", type="string", length=255)
     */
    private $dbImage = 'test@gmail.com';


    /**
     * @var bool
     *
     * @ORM\Column(name="db_employer", type="boolean" , nullable= TRUE)
     */
    private $dbEmployer = 0;

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
     * @return db_users
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
     * Set dbEmail
     *
     * @param string $dbEmail
     *
     * @return db_users
     */
    public function setDbEmail($dbEmail)
    {
        $this->dbEmail = $dbEmail;

        return $this;
    }

    /**
     * Get dbEmail
     *
     * @return string
     */
    public function getDbEmail()
    {
        return $this->dbEmail;
    }

    /**
     * Set dbPassword
     *
     * @param string $dbPassword
     *
     * @return db_users
     */
    public function setDbPassword($dbPassword)
    {
        $this->dbPassword = $dbPassword;

        return $this;
    }

    /**
     * Get dbPassword
     *
     * @return string
     */
    public function getDbPassword()
    {
        return $this->dbPassword;
    }

    /**
     * Set dbContact
     *
     * @param string $dbContact
     *
     * @return db_users
     */
    public function setDbContact($dbContact)
    {
        $this->dbContact = $dbContact;

        return $this;
    }

    /**
     * Get dbContact
     *
     * @return string
     */
    public function getDbContact()
    {
        return $this->dbContact;
    }

    /**
     * Set dbImage
     *
     * @param string $dbImage
     *
     * @return db_users
     */
    public function setDbImage($dbImage)
    {
        $this->dbImage = $dbImage;

        return $this;
    }

    /**
     * Get dbImage
     *
     * @return string
     */
    public function getDbImage()
    {
        return $this->dbImage;
    }



    /**
     * Set dbEmployer
     *
     * @param boolean $dbEmployer
     *
     * @return db_users
     */
    public function setDbEmployer($dbEmployer)
    {
        $this->dbEmployer = $dbEmployer;

        return $this;
    }

    /**
     * Get dbEmployer
     *
     * @return bool
     */
    public function getDbEmployer()
    {
        return $this->dbEmployer;
    }

}

