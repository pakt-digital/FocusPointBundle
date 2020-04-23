<?php

namespace PaktDigital\FocusPointBundle\Entity;

interface ImageInterface
{
    public function getFocusPoint();

    public function setFocusPoint(array $focusPoint): self;
}
