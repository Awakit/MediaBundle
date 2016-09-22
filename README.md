Installation instruction
===================

### Composer

Add those lines to your composer.json

```yaml
#composer.json
    "require": {
        ...
      "awakit/media-bundle": "~3.*"
    },

    "repositories": [
        ...
        { "type": "composer", "url": "http://packages.awakit:8000/" }
    ],
```

### Kernel

Add thoses bundles to your AppKernel.php

```PHP
    new Liip\ImagineBundle\LiipImagineBundle(),
    new Symfony\Bundle\AsseticBundle\AsseticBundle(),
    new Knp\DoctrineBehaviors\Bundle\DoctrineBehaviorsBundle(),
    new Awakit\MediaBundle\AwakitMediaBundle(),
```

### Routing

Add thoses route to your routing.yml

```yaml
#app/config/routing.yml
media:
    resource: "@AwakitMediaBundle/Resources/config/routing.yml"
```
    
    
### Config

Add theses to your config.yml
see [LiipImagineBundle Configuration](http://symfony.com/doc/current/bundles/LiipImagineBundle/configuration.html)

```yaml

doctrine:
    dbal:
        types:
            json: Doctrine\DBAL\Types\JsonArrayType
            
            
awakit_media:
    upload_folder: /media

liip_imagine:
    filter_sets:
        full:
            quality: 100
        thumb:
            quality: 75
            filters:
                thumbnail: { size: [120, 90], mode: outbound }
```
    
If you want another folder for your uploads, don't forget to modify liip setting as well

```
awakit_media:
    upload_folder: /AnotherFolder

liip_imagine:
    resolvers:
        default:
            web_path:
                cache_prefix: AnotherFolder/cache
```

###Providers
For the moment only Image and File provider are available.

### Twig
To insert a media in the twig, use the block with an optionnal filter name, defined in the liip_imagine.filter_sets section.
If you don't provider a filter name, 'reference' filter is default. it will return the original media uploaded with any filter or post processing.
```
{% media mediaObject, '<filter>' %}
```

you can also ask for the path directly
```
{% path media, '<filter>' %}
```


### FormType
a Awakit\MediaBundle\Form\Type\MediaType is available. provider option is mandatory.
```
$builder->add(<fieldName>,MediaType::class, array('provider'=> 'image'));