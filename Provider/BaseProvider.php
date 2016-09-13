<?php

namespace Awakit\MediaBundle\Provider;

use Awakit\MediaBundle\Entity\Media;
use Awakit\MediaBundle\Provider\Exception\InvalidMimeTypeException;


/**
 * description 
 * @author Donjohn
 */
abstract class BaseProvider implements ProviderInterface {

    /**
     * @var string
     */
    protected $alias='';

    /**
     * @var array
     */
    public $allowedTypes=array();


    final public function setAlias($alias)
    {
        $this->alias = $alias;
        return $this;
    }

    final public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @inheritdoc
     */
    public function render(\Twig_Environment $twig, Media $media, $options = array()){
        return $twig->render(sprintf('AwakitMediaBundle:Provider:media.%s.html.twig', $this->getAlias()),
                            array_merge($options, array('media' => $media))
                            );
    }

    /**
     * {@inheritdoc}
     */
    final public function validateMimeType($type)
    {
        if (count($this->allowedTypes)> 0 && !in_array($type,$this->allowedTypes)) throw new InvalidMimeTypeException(sprintf('provider %s does not support %s, it supports only [%s]', $this->getAlias(), $type, implode(',', $this->allowedTypes)));
        return true;
    }

    public function postLoad(Media $oMedia)
    {
        $oMedia->setMediaPath($this->getPath($oMedia));
    }


}
