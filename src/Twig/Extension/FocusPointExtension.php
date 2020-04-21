<?php

namespace PaktDigital\FocusPointBundle\Twig\Extension;

use PaktDigital\FocusPointBundle\Entity;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class FocusPointExtension extends AbstractExtension
{
	private CacheManager $cache;

	private UploaderHelper $uploaderHelper;

	public function __construct(CacheManager $cache, UploaderHelper $uploaderHelper)
	{
		$this->cache = $cache;

		$this->uploaderHelper = $uploaderHelper;
	}

	public function getFilters()
	{
		return [
			new TwigFilter('paktdigital_focus', [$this, 'filter']),
		];
	}

	public function filter(Entity\ImageInterface $image, $filter, array $config = [], $resolver = null)
	{
		$path = $this->uploaderHelper->asset($image, 'imageFile');

		$config = array_merge($config, [
			'paktdigital.filter.focuspoint' => $image->getFocusPoint(),
		]);

		return $this->cache->getBrowserPath(parse_url($path, PHP_URL_PATH), $filter, $config, $resolver);
	}
}
