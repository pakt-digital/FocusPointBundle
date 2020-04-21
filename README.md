[Pakt.digital](https://www.pakt.digital/)
# FocusPointBundle

Docs and repo are WIP, package not released yet.

Requires:
- liip/imagine-bundle
- vich/uploader-bundle
- symfony/twig-bundle

## Configuration

Configuration yml file
```yml
paktdigital_focus_point:
    image_entity: '\App\Entity\Media\Image'
```

liip_image.yml
```yaml
testImage:
    quality: 100
    filters:
        paktdigital.filter.focuspoint:
            size: [500, 500]
```

Image class
```php
use PaktDigital\FocusPointBundle\Entity\ImageInterface;

class Image implements ImageInterface
```

Field type
```
PaktDigital\FocusPointBundle\Form\ImageFocusType
```

Twig filter
```twig
<img src="{{ page.image | paktdigital_focus('testImage') }}" />
```
