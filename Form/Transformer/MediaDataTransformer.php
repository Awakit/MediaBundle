<?php

namespace Awakit\MediaBundle\Form\Transformer;

use Awakit\MediaBundle\Provider\ProviderInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Awakit\MediaBundle\Model\Media;


class MediaDataTransformer implements DataTransformerInterface
{
    /**
     * @var \Awakit\MediaBundle\Provider\ProviderInterface
     */
    protected $provider;
    protected $class;

    public function __construct(ProviderInterface $provider, $class)
    {
        $this->provider = $provider;
        $this->class = $class;
    }

    /**
     * {@inheritdoc}
     */
    public function transform($value)
    {
        if ($value === null) {
            return new $this->class();
        }

        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($oMedia)
    {
        if (!($oMedia instanceof Media) || (!$oMedia->getBinaryContent() instanceof \SplFileInfo)) return $oMedia;

        $this->provider->transform($oMedia);

        return $oMedia;
    }
}

