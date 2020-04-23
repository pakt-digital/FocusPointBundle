<?php

namespace PaktDigital\FocusPointBundle\Entity;

interface ImageInterface
{
    public function getFocusPoint(): array;

    public function setFocusPoint(array $focusPoint): self;
}
