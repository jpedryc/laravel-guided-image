<?php

declare(strict_types=1);

namespace ReliqArts\GuidedImage\DTO;

use Illuminate\Http\Request;
use ReliqArts\GuidedImage\Contracts\GuidedImage;

abstract class ExistingImageDemand extends ImageDemand
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var GuidedImage
     */
    private $guidedImage;

    /**
     * ExistingImageDemand constructor.
     *
     * @param Request     $request
     * @param GuidedImage $guidedImage
     * @param mixed       $width
     * @param mixed       $height
     * @param mixed       $returnObject
     */
    public function __construct(Request $request, GuidedImage $guidedImage, $width, $height, $returnObject = null)
    {
        parent::__construct($width, $height, $returnObject);

        $this->request = $request;
        $this->guidedImage = $guidedImage;
    }

    /**
     * @return Request
     */
    final public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * @return GuidedImage
     */
    final public function getGuidedImage(): GuidedImage
    {
        return $this->guidedImage;
    }
}
