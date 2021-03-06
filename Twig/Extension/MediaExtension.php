<?php
/**
 * @author jgn
 * @date 07/03/2016
 * @description For ...
 */

namespace Awakit\MediaBundle\Twig\Extension;


use Awakit\MediaBundle\Model\Media;
use Awakit\MediaBundle\Provider\Exception\NotFoundProviderException;
use Awakit\MediaBundle\Provider\Factory\ProviderFactory;
use Awakit\MediaBundle\Twig\TokenParser\MediaTokenParser;
use Awakit\MediaBundle\Twig\TokenParser\PathTokenParser;


class MediaExtension extends \Twig_Extension
{
    /**
     * @var ProviderFactory $providerFactory
     */
    protected $providerFactory;

    /**
     * @var \Twig_Environment $twig
     */
    protected $twig;

    /**
     * MediaExtension constructor.
     * @param \Awakit\MediaBundle\Provider\Factory\ProviderFactory $providerFactory
     */
    public function __construct(ProviderFactory $providerFactory, \Twig_Environment $twig)
    {
        $this->providerFactory = $providerFactory;
        $this->twig = $twig;
    }


    /**
     * {@inheritdoc}
     */
    public function getTokenParsers()
    {
        return array(
            new MediaTokenParser(self::class),
            new PathTokenParser(self::class),
        );
    }

    public function getName()
    {
        return 'awakit_media';
    }

    public function media(Media $media = null, $filter, $attributes)
    {

        try {
            $provider = $this->providerFactory->getProvider($media);
        }
        catch (NotFoundProviderException $e) {
            return '';
        }
        $attributes = array_merge($attributes, array('filter' => $filter));
        return $provider->render($this->twig, $media, $attributes);

    }


    public function path(Media $media = null, $filter)
    {
        try {
            $provider = $this->providerFactory->getProvider($media);
        }
        catch (NotFoundProviderException $e) {
            return '';
        }
        return $provider->getPath($media, $filter);

    }

}
