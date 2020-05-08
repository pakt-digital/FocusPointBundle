[Pakt.digital](https://www.pakt.digital/)
# FocusPointBundle

This Symfony bundle provides an liip/imagine-bundle filter extension, a form type (using VichImageType) and an optional Twig extension for [third774's image focus](https://github.com/third774/image-focus).

Requires:
- liip/imagine-bundle
- vich/uploader-bundle

## Usage

### Image entity
Implement `ImageInterface` in the entity you use for your images
```php
use PaktDigital\FocusPointBundle\Entity\ImageInterface;

class Image implements ImageInterface
```

and add
```php
/**
  * @ORM\Column(type="json_array")
  */
private $focusPoint = [];

public function getFocusPoint(): ?array
{
    return $this->focusPoint;
}

public function setFocusPoint(array $focusPoint): self
{
    $this->focusPoint = $focusPoint;

    return $this;
}
```

Configure `image_entity` in the yaml file with your image entity
```yml
paktdigital_focus_point:
    image_entity: '\App\Entity\Media\Image'
```

### The filter

You can apply the filter to an image by adding `paktdigital.focuspoint` to the image's filters in the `liip_image.yml` configuration
```yaml
exampleImage:
    quality: 100
    filters:
        paktdigital.focuspoint:
            size: [500, 500]
```

### Field type
Add `ImageFocusType` to your form and add the css class `js-focus-picker`, e.g. in EasyAdmin
```yaml
Page:
    class: App\Entity\Page
    form:
        fields:
            - { property: 'image', type: 'PaktDigital\FocusPointBundle\Form\ImageFocusType', css_class: 'js-focus-picker' }
            - active
            - title
            - intro
            - active
```
and add the assets
```yaml
assets:
    js:
    - '/bundles/paktdigitalfocuspoint/main.js'
    css:
    - '/bundles/paktdigitalfocuspoint/main.css'
```

### In Twig
Twig filter extension
```twig
<img src="{{ examplePage.image | paktdigital_focus('exampleImage') }}" />
```
