<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * db_students
 *
 * @ORM\Table(name="db_students")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\db_studentsRepository")
 */
class db_students
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
     * @ORM\Column(name="db_cv", type="text")
     */
    private $dbCv = '<div style="text-align: right;"><img src="file:///C:/Users/Job/AppData/Local/Temp/msohtmlclip1/01/clip_image001.gif">Curriculum Vitae of John Doe</div><div><img src="file:///C:/Users/Job/AppData/Local/Temp/msohtmlclip1/01/clip_image003.jpg" style="color: gray; font-family: &quot;Lucida Sans Unicode&quot;, sans-serif;"></div><div><span style="color: gray; font-family: &quot;Lucida Sans Unicode&quot;, sans-serif; font-size: 22pt;">John Doe</span></div><div><span style="color: black; font-family: &quot;Lucida Sans Unicode&quot;, sans-serif;">Sales Manager</span></div><div><span style="font-family: &quot;Lucida Sans Unicode&quot;, sans-serif; font-size: 10pt;">&nbsp;</span></div><div><span style="font-family: &quot;Lucida Sans Unicode&quot;, sans-serif; font-size: 10pt;">Address 1</span></div><div><span style="font-family: &quot;Lucida Sans Unicode&quot;, sans-serif; font-size: 10pt;">Address 2</span></div><div><span style="font-family: &quot;Lucida Sans Unicode&quot;, sans-serif; font-size: 10pt;">Address 3</span></div><div><span style="font-family: &quot;Lucida Sans Unicode&quot;, sans-serif; font-size: 10pt;">Tel: phone no here</span></div><div><span style="font-family: &quot;Lucida Sans Unicode&quot;, sans-serif; font-size: 10pt;">Email: </span><span style="font-family: &quot;Lucida Sans Unicode&quot;, sans-serif; font-size: 10pt; color: gray;">email@email.com</span></div><div><span style="color: gray; font-family: &quot;Lucida Sans Unicode&quot;, sans-serif;">&nbsp;</span></div><div style="text-align: center;">PROFILE</div><div>&nbsp;</div><div><span style="font-family: &quot;Lucida Sans Unicode&quot;, sans-serif;">See section on personal profiles</span></div><div><span style="color: gray; font-family: &quot;Lucida Sans Unicode&quot;, sans-serif;">&nbsp;</span></div><div>RELEVANT SKILLS</div><div>&nbsp;</div><div><span style="color: gray; font-family: &quot;Lucida Sans Unicode&quot;, sans-serif;">&nbsp;</span></div><div><span style="color: windowtext;">EDUCATION</span></div><div>&nbsp;</div><div><i style="font-family: &quot;Arial Narrow&quot;, sans-serif; font-size: 11pt;">Qualification title here</i><span style="font-family: &quot;Arial Narrow&quot;, sans-serif; font-size: 11pt;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Academic Institution Name - City, State &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2001-2004</span></div><div><span style="font-family: &quot;Arial Narrow&quot;, sans-serif;">&nbsp;</span></div><div><i style="font-family: &quot;Arial Narrow&quot;, sans-serif; font-size: 11pt;">Qualification title here</i><span style="font-family: &quot;Arial Narrow&quot;, sans-serif; font-size: 11pt;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Academic Institution Name - City, State&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 1975-1980 </span></div><div><span style="font-family: &quot;Arial Narrow&quot;, sans-serif;">&nbsp;</span></div><div><span style="font-family: &quot;Lucida Sans Unicode&quot;, sans-serif; font-size: 14pt;">WORK EXPERIENCE</span></div><div>&nbsp;</div><div><i style="font-family: &quot;Arial Narrow&quot;, sans-serif; font-size: 11pt;">Job Title Here</i><span style="font-family: &quot;Arial Narrow&quot;, sans-serif; font-size: 11pt;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Business Name - Location&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2001-2002 </span></div><div><b>&nbsp;</b></div><div><i style="font-family: &quot;Arial Narrow&quot;, sans-serif; font-size: 11pt;">Job Title Here</i><span style="font-family: &quot;Arial Narrow&quot;, sans-serif; font-size: 11pt;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Business Name - Location&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2003-2004</span></div><div><span style="font-family: &quot;Arial Narrow&quot;, sans-serif;">&nbsp;</span></div><div>OTHER SKILLS</div><div style="text-align: center;"><span style="color: gray; font-family: &quot;Lucida Sans Unicode&quot;, sans-serif;">&nbsp;</span></div><ul><li style="text-align: justify;"><span style="font-family: &quot;Arial Narrow&quot;, sans-serif;">Hobbies or other skills that are not detailed in      the CV.</span></li></ul><div><span style="color: gray; font-family: &quot;Lucida Sans Unicode&quot;, sans-serif;">&nbsp;</span></div><div>REFERENCES</div><div><span style="font-family: &quot;Arial Narrow&quot;, sans-serif;">&nbsp;</span></div><div><span style="font-family: &quot;Arial Narrow&quot;, sans-serif;">Available upon request.</span></div><div>&nbsp;</div>';

    /**
     * @var bool
     *
     * @ORM\Column(name="db_employed", type="boolean")
     */
    private $dbEmployed = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="db_image", type="string", length=255)
     */
    private $dbImage = 'test@gmail.com' ;


    /**
     * @var int
     *
     * @ORM\Column(name="db_job_id", type="integer")
     */
    private $dbJobId = 0;



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
     * @return db_students
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
     * @return db_students
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
     * @return db_students
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
     * Set dbCv
     *
     * @param string $dbCv
     *
     * @return db_students
     */
    public function setDbCv($dbCv)
    {
        $this->dbCv = $dbCv;

        return $this;
    }

    /**
     * Get dbCv
     *
     * @return string
     */
    public function getDbCv()
    {
        return $this->dbCv;
    }

    /**
     * Set dbEmployed
     *
     * @param boolean $dbEmployed
     *
     * @return db_students
     */
    public function setDbEmployed($dbEmployed)
    {
        $this->dbEmployed = $dbEmployed;

        return $this;
    }

    /**
     * Get dbEmployed
     *
     * @return bool
     */
    public function getDbEmployed()
    {
        return $this->dbEmployed;
    }

    /**
     * Set dbImage
     *
     * @param string $dbImage
     *
     * @return db_students
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
     * Set dbJobId
     *
     * @param integer $dbJobId
     *
     * @return db_comments
     */
    public function setDbJobId($dbJobId)
    {
        $this->dbJobId = $dbJobId;

        return $this;
    }

    /**
     * Get dbJobId
     *
     * @return int
     */
    public function getDbJobId()
    {
        return $this->dbJobId;
    }


}

