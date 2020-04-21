<?php

namespace PaktDigital\FocusPointBundle;

use PaktDigital\FocusPointBundle\DependencyInjection\PaktDigitalFocusPointExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class PaktDigitalFocusPointBundle extends Bundle
{
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new PaktDigitalFocusPointExtension();
        }

        return $this->extension;
    }
}
