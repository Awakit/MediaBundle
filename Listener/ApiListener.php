<?php
namespace Awakit\MediaBundle\Listener;

use Awakit\MediaBundle\Model\Media;
use Awakit\MediaBundle\Provider\Factory\ProviderFactory;
use Dunglas\ApiBundle\Event\DataEvent;


/**
 * Description of MediaSubscriber
 *
 * @author Donjohn
 */
class ApiListener
{
    private $providerFactory;

    public function __construct(ProviderFactory $providerFactory) {
        $this->providerFactory = $providerFactory;
    }



    /**
     * @param DataEvent $event
     */
    public function onPreCreate(DataEvent $event)
    {
        $data = $event->getData();

        if ($data instanceof Media) {
            $this->providerFactory->getProvider($data->getProviderName())->transform($data);
        }
    }

    /**
     * @param DataEvent $event
     */
    public function onPostCreate(DataEvent $event)
    {
        $data = $event->getData();

        if ($data instanceof Media) {
            $this->providerFactory->getProvider($data->getProviderName())->postLoad($data);
        }
    }
}