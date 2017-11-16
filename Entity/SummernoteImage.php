<?php

namespace Toinou\SummernoteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SummernoteImage
 *
 * @ORM\Table(name="summernote_image")
 * @ORM\Entity(repositoryClass="Toinou\SummernoteBundle\Repository\SummernoteImageRepository")
 */
class SummernoteImage
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var file
     *
     */
    private $file;


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
     * Set name
     *
     * @param string $name
     *
     * @return SummernoteImage
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get file
     *
     * @return file
     */
    public function getFile()
    {
        return $this->file;
    }
    /**
     * Set file
     *
     * @param $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }
}

