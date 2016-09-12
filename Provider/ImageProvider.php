<?php

namespace Awakit\MediaBundle\Provider;

use Awakit\MediaBundle\Entity\Media;
use Imagine\Imagick\Imagine;

/**
 * description 
 * @author Donjohn
 */
class ImageProvider extends FileProvider  {
    
    public $allowedTypes=array('image/jpeg');

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
    
}
