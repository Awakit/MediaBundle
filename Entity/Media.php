<?php
namespace Awakit\MediaBundle\Entity;

use Awakit\MediaBundle\Provider\ProviderInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Debug\Exception\ContextErrorException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;



/**
 * description 
 * @author Donjohn
 * @ORM\Entity(repositoryClass="Awakit\MediaBundle\Repository\MediaRepository")
*/


class Media
{
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
    */
    protected $id;
    
    /**
     * @ORM\Column(type="string", nullable=false)
    */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    protected $providerName;
    
    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected $filename;
    
    protected $oldFilename;

    /**
     * @var string full url of the media
     */
    protected $filePath;
    
    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected $mimeType;
    
    protected $oldMimeType;
    
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $enabled=true;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;
    
    /**
     * @ORM\Column(type="json_array", nullable=true)
     */
    protected $metadata=array();
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $width;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $height;
    
    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $position=0;
    
    
    protected $binaryContent;

    /**
     * return old Media
     * @return Media
     */
    public function getOldMedia()
    {
        $oldMedia = clone $this;
        $oldMedia->setFilename($this->oldFilename);
        $oldMedia->setMimeType($this->oldMimeType);
        return $oldMedia;
    }

    /**
     * init old value
     * @return Media
     */
    public function setOldMedia()
    {
        $this->oldMimeType=$this->mimeType;
        $this->oldFilename=$this->filename;
        return $this;
    }


        /**
     * Get mediaId
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Media
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

    public function __toString()
    {
        return $this->name ?: '';
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Media
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set metadata
     *
     * @param array $metadata
     * @return Media
     */
    public function setMetadata($metadata)
    {
        $this->metadata = $metadata;

        return $this;
    }
    
    /**
     * add metadata
     *
     * @param string $key
     * @param mixed $value
     * @return Media
     */
    public function addMetadata($key, $value)
    {
        $this->metadata[$key] = $value;

        return $this;
    }

    /**
     * Get metadata
     *
     * @return array
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Media
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set width
     *
     * @param integer $width
     * @return Media
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return integer 
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set height
     *
     * @param integer $height
     * @return Media
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return integer 
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Media
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * init l'old media et fous le contenu d'un binaire dans la variable.
     * @param $binaryContent
     * @return $this
     */
    public function setBinaryContent($binaryContent)
    {
        $this->setOldMedia();
        $this->binaryContent = $binaryContent;
        return $this;
    }

    /**
     * @return \SplFileInfo|File|UploadedFile
     */
    public function getBinaryContent()
    {
        return $this->binaryContent;
    }

    /**
     * Set mimeType
     *
     * @param string $mimeType
     * @return Media
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * Get mimeType     *
     *
     * @var string $return quel partie ?
     * @return string
     */
    public function getMimeType($return='full')
    {
        $full = $this->mimeType;
        try {list($provider, $type) = explode('/', $this->mimeType);}
        catch (ContextErrorException $e) {$return = 'full';}

        return ${$return};
    }

    /**
     * get Provider
     * @return ProviderInterface string
     */
    public function getProvider()
    {
        return $this->getMimeType('provider');
    }

    /**
     * get type
     * @return string
     */
    public function getType()
    {
        return $this->getMimeType('type');
    }
            

    /**
     * Set filename
     *
     * @param string $filename
     * @return Media
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }
    
    /**
     * return old filename for delete/update
     * @return string
     */
    public function getOldFilename()
    {
        return $this->oldFilename;
    }

    public function setFilePath($filePath)
    {
        $this->filePath = $filePath;
    }

    public function getFilePath()
    {
        return $this->filePath;
    }

    /**
     * Set providerName
     *
     * @param string $providerName
     *
     * @return Media
     */
    public function setProviderName($providerName)
    {
        $this->providerName = $providerName;

        return $this;
    }

    /**
     * Get providerName
     *
     * @return string
     */
    public function getProviderName()
    {
        return $this->providerName;
    }
}
