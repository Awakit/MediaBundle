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
    upload_folder: /uploads

liip_imagine:
    filter_sets:
        full:
            quality: 100
        thumb:
            quality: 75
            filters:
                thumbnail: { size: [120, 90], mode: outbound }
```
    
