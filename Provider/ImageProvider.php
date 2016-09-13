<?php

namespace Awakit\MediaBundle\Provider;

use Awakit\MediaBundle\Entity\Media;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;

/**
 * description 
 * @author Donjohn
 */
class ImageProvider extends FileProvider  {
    
    public $allowedTypes=array('image/jpeg');
    /**
     * @var CacheManager $cacheManager
     */
    protected $cacheManager;

    public function __construct($rootFolder, $uploadFolder, CacheManager $cacheManager)
    {
        $this->cacheManager = $cacheManager;
        parent::__construct($rootFolder, $uploadFolder);
    }

    public function extractMetaData(Media $oMedia)
    {
//
//        try {
//            $this->adapter = new Imagine();
//            $this->adapter->open($this->filesystem->get($oMedia)->getKey());
//        } catch (\Exception $e) {
//            //throw new \RuntimeException($e->getMessage());
//        }
    }

    public function getPath(Media $oMedia, $format= null)
    {
        $path = parent::getPath($oMedia);
        return  $format ? $this->cacheManager->getBrowserPath($path, $format): $path;
    }
    
}
