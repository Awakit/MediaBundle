<?php
/**
 * @author jgn
 * @date 12/09/2016
 * @description For ...
 */

namespace Awakit\MediaBundle\Form;


use Awakit\MediaBundle\Entity\Media;
use Awakit\MediaBundle\Form\Transformer\MediaDataTransformer;
use Awakit\MediaBundle\Provider\Factory\ProviderFactory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MediaType extends AbstractType
{
    /**
     * @var ProviderFactory
     */
    public $providerFactory;

    public function __construct( ProviderFactory $providerFactory)
    {
        $this->providerFactory = $providerFactory;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired(array('provider'));
        $resolver->setDefaults(array(
                'data_class' => 'Awakit\MediaBundle\Entity\Media',
                'error_bubbling' => true
                ));
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $provider = $this->providerFactory->getProvider($options['provider']);
        if ($builder->getData() instanceof Media && $builder->getData()->getId()) $provider->addEditForm($builder);
        else $provider->addCreateForm($builder);

        $builder->addModelTransformer(new MediaDataTransformer($provider));

    }


}