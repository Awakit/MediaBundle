<?php
/**
 * @author jgn
 * @date 13/09/2016
 * @description For ...
 */

namespace Awakit\MediaBundle\Manager;


use Awakit\MediaBundle\Entity\Media;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class BaseManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;
    /**
     * @var string
     */
    protected $class;
    public function save(Media $oMedia, $flush = true)
    {
        $this->em->persist($oMedia);
        if ($flush) $this->em->flush();
    }

    /**
     * BaseManager constructor.
     * @param \Doctrine\ORM\EntityManagerInterface $em
     * @param $class
     */
    public function __construct(EntityManagerInterface $em, $class)
    {
        $this->em = $em;
        $this->class = $class;
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository|EntityRepository
     */
    public function getRepository()
    {
        return $this->em->getRepository($this->class);
    }
}