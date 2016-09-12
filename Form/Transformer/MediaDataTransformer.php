<?php

namespace Awakit\MediaBundle\Form\Transformer;

use Awakit\MediaBundle\Provider\Exception\InvalidMimeTypeException;
use Awakit\MediaBundle\Provider\ProviderInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Awakit\MediaBundle\Entity\Media;



class MediaDataTransformer implements DataTransformerInterface
{
    /**
     * @var \Awakit\MediaBundle\Provider\ProviderInterface
     */
    protected $provider;

    public function __construct(ProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    /**
     * {@inheritdoc}
     */
    public function transform($value)
    {
        if ($value === null) {
            return new Media();
        }

        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($oMedia)
    {
        if (!($oMedia instanceof Media) || (!$oMedia->getBinaryContent() instanceof \SplFileInfo)) return $oMedia;


        $mimeType = $oMedia->getBinaryContent()->getMimeType();
        try {
            $this->provider->validateMimeType($mimeType);
            $oMedia->setMimeType($mimeType);
        } catch (InvalidMimeTypeException $e) {
            throw new TransformationFailedException($e->getMessage());
        }

//        $this->provider->reverseTransform($oMedia);
        try {
            $this->provider->reverseTransform($oMedia);
        } catch (\Exception $e) {
            throw new TransformationFailedException('invalid file');
        }

        $oMedia->setProviderName($this->provider->getAlias());


        return $oMedia;
    }
}

