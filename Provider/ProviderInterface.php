<?php

namespace Awakit\MediaBundle\Provider;

use Awakit\MediaBundle\Entity\Media;
use Awakit\MediaBundle\Provider\Exception\InvalidMimeTypeException;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * description 
 * @author Donjohn
 */
interface ProviderInterface {

    /**
     * @param string $alias provider alias
     */
    public function setAlias($alias);

    /**
     * @return string alias
     */
    public function getAlias();
    
    /**
     * validate the mimeType of the file
     * @throws InvalidMimeTypeException
     */
    public function validateMimeType($type);

    /**
     * @param \Twig_Environment $twig_Environment
     * @param \Awakit\MediaBundle\Entity\Media $media
     * @return mixed
     */
    public function render(\Twig_Environment $twig_Environment, Media $media, $options = array());

    /**
     * extract data from media, size/height/etc..;
     * @param Media $oMedia
     * @return array metadatas
     */
    public function extractMetaData(Media $oMedia);

    /**
     * function called on postLoad Dcotrine Event on MEdia entity
     * @param Media $oMedia
     */
    public function postLoad(Media $oMedia);

    /**
     * function called on prePersist Dcotrine Event on MEdia entity
     * @param Media $oMedia
     */
    public function prePersist(Media $oMedia);

    /**
     * function called on postPerstist Dcotrine Event on MEdia entity
     * @param Media $oMedia
     */
    public function postPersist(Media $oMedia);

    /**
     * function called on postUpdate Dcotrine Event on MEdia entity
     * @param Media $oMedia
     */
    public function postUpdate(Media $oMedia);

    /**
     * function called on postRemove Dcotrine Event on MEdia entity
     * @param Media $oMedia
     */
    public function postRemove(Media $oMedia);


    /**
     * add edit fields for the defined provider
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @return mixed
     */
    public function addEditForm(FormBuilderInterface $builder);

    /**
     * add create fields for the defined provider
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @return mixed
     */
    public function addCreateForm(FormBuilderInterface $builder);

    /**
     * return path of the media, depends on the media ^^
     * @param \Awakit\MediaBundle\Entity\Media $oMedia
     * @return mixed
     */
    public function getPath(Media $oMedia, $filter= null);


    
}
