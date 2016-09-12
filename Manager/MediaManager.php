<?php
namespace Awakit\MediaBundle\Manager;

use Awakit\MediaBundle\Entity\Media;
use Doctrine\ORM\Decorator\EntityManagerDecorator;

/**
 * @author Donjohn
 */ 
    
class MediaManager extends EntityManagerDecorator
{

    public function save(Media $oMedia, $flush = true)
    {
        $this->persist($oMedia);
        if ($flush) $this->flush();
    }

}

