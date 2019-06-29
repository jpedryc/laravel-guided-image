<?php

declare(strict_types=1);

namespace ReliqArts\GuidedImage\Demands;

use Illuminate\Http\Request;
use ReliqArts\GuidedImage\Contracts\GuidedImage;

class Thumbnail extends ExistingImage
{
    private const METHOD_CROP = 'crop';
    private const METHOD_FIT = 'fit';
    private const METHODS = [self::METHOD_CROP, self::METHOD_FIT];

    /**
     * @var string
     */
    private $method;

    /**
     * Thumbnail constructor.
     *
     * @param Request     $request
     * @param GuidedImage $guidedImage
     * @param string      $method
     * @param mixed       $width
     * @param mixed       $height
     * @param bool        $returnObject
     */
    public function __construct(
        Request $request,
        GuidedImage $guidedImage,
        string $method,
        $width,
        $height,
        bool $returnObject = null
    ) {
        parent::__construct($request, $guidedImage, $width, $height, $returnObject);

        $this->method = $method;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return in_array($this->method, self::METHODS, true);
    }
}