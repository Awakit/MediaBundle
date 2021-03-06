<?php

namespace Awakit\MediaBundle\Provider;

use Awakit\MediaBundle\Model\Media;
use Awakit\MediaBundle\Provider\Exception\InvalidMimeTypeException;
use Symfony\Component\Form\Exception\TransformationFailedException;
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
     * @param \Awakit\MediaBundle\Model\Media $media
     * @return string
     */
    public function render(\Twig_Environment $twig_Environment, Media $media, $options = array());


    /**
     * @param \Awakit\MediaBundle\Model\Media $oMedia
     * @throws TransformationFailedException
     */
    public function transform(Media $oMedia);

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
    public function addEditForm(FormBuilderInterface $builder, array $options);

    /**
     * add create fields for the defined provider
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @return mixed
     */
    public function addCreateForm(FormBuilderInterface $builder, array $options);

    /**
     * return path of the media, depends on the media ^^
     * @param \Awakit\MediaBundle\Model\Media $oMedia
     * @return mixed
     */
    public function getPath(Media $oMedia, $filter= null);


    
}
