<?php
namespace Awakit\MediaBundle\Listener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;

use Awakit\MediaBundle\Entity\Media;
use Awakit\MediaBundle\Provider\Factory\ProviderFactory;

/**
 * Description of MediaSubscriber
 *
 * @author Donjohn
 */
class MediaSubscriber implements EventSubscriber {
    
    private $providerFactory;
    
    public function __construct(ProviderFactory $providerFactory) {
        $this->providerFactory = $providerFactory;
    }
    
    public function getSubscribedEvents() {
        return array(
            'postPersist',
            'postUpdate',
            'postLoad',
        );
    }
    
    /**
     * event declenché à la creation de l'objet, sert à sauver le fichier si uploadé
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $args
     */
    public function postPersist(LifecycleEventArgs $args) {
        $oMedia = $args->getEntity();
        if ($oMedia instanceof Media )$this->providerFactory->getProvider($oMedia)->postPersist($oMedia);
    }

    /**
     * declenché à l'update de l'objet, sert à delete l'ancien fichier si yen a un nouveau
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $args
     */
    public function postUpdate(LifecycleEventArgs $args) {
        $oMedia = $args->getEntity();
        if ($oMedia instanceof Media) $this->providerFactory->getProvider($oMedia)->postUpdate($oMedia);
    }


    /**
     * event declenché apres le mapping de l'objet, sert à chopper le path de l'image
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $args
     */
    public function postLoad(LifecycleEventArgs $args) {
        $oMedia = $args->getEntity();
        if ($oMedia instanceof Media ) {
            $oMedia->setOldMedia(); //in case you delete it ^^
            $this->providerFactory->getProvider($oMedia)->postLoad($oMedia);
        }
    }

    
    
}