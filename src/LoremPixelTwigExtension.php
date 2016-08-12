<?php

namespace LoremPixelTwigExtension;

use Twig_Extension;
use Twig_SimpleFunction;

/**
 * Twig extension for LoremPixel integration.
 */
class LoremPixelTwigExtension extends Twig_Extension
{
    /**
     * The host of the lorempixel service.
     *
     * @var string|null
     */
    private $HOST = 'http://lorempixel.com/';

    /**
     * The name of the extension.
     *
     * @return string Returns the nmae of the extension.
     */
    public function getName()
    {
        return 'lorempixel';
    }

    /**
     * Get the extension related functions.
     *
     * @return array Returns the extension related functions.
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction(
                'lorempixel',
                [$this, 'generateLoremPixelImageUrl'],
                ['is_safe' => ['html']]
            ),
        ];
    }

    /**
     * Generate the lorempixel image url.
     *
     * @param bool|null   $gray     Is it a gray image?
     * @param int|null    $width    The width of the image.
     * @param int|null    $height   The height of the image.
     * @param string|null $category The category of the image.
     * @param int|null    $number   The number of the image from the given category.
     * @param string|null $text     The custom text to add to the image.
     *
     * @return string The lorempixel image url.
     */
    public function generateLoremPixelImageUrl($gray = false, $width = 400, $height = 200, $category = null, $number = null, $text = null)
    {
        $url = $this->HOST;
        $options = array();
        if ($gray) {
            $options[] = 'g';
        }
        if ($width) {
            $options[] = $width;
        }
        if ($height) {
            $options[] = $height;
        }
        if ($category) {
            $options[] = $category;
        }
        if ($category && $number) {
            $options[] = $number;
        }
        if ($text) {
            $options[] = $text;
        }
        $options[] = '';

        return $url.implode('/', $options);
    }
}
