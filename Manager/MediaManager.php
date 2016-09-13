<?php
namespace Awakit\MediaBundle\Manager;

use Awakit\MediaBundle\Repository\MediaRepository;

/**
 * @author Donjohn
 */ 
    
class MediaManager extends BaseManager
{

    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository|\Doctrine\ORM\EntityRepository|MediaRepository
     */
    public function getRepository()
    {
        return parent::getRepository();
    }

}

