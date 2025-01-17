<?php

declare(strict_types=1);

namespace ReliqArts\GuidedImage\Contract;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Http\UploadedFile;
use ReliqArts\GuidedImage\Demand\Resize;
use ReliqArts\GuidedImage\Result;

/**
 * A true guided image defines.
 *
 * @mixin Model
 * @mixin Builder
 * @mixin QueryBuilder
 */
interface GuidedImage
{
    /**
     *  Get image name.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get resized/thumbnail photo link.
     *
     * @param string $type   request type (thumbnail or resize)
     * @param array  $params parameters to pass to route
     *
     * @return string
     */
    public function getRoutedUrl(string $type, array $params = []): string;

    /**
     *  Get image title.
     *
     * @return string
     */
    public function getTitle(): string;

    /**
     *  Get URL/path to image.
     *
     * @param bool $diskRelative whether to return `full path` (relative to disk),
     *                           hence skipping call to Storage facade
     *
     * @return string
     *
     * @uses \Illuminate\Support\Facades\Storage
     */
    public function getUrl(bool $diskRelative = false): string;

    /**
     * Whether image is safe for deleting.
     * Since a single image may be re-used this method is used to determine
     * when an image can be safely deleted from disk.
     *
     * @param int $safeAmount a photo is safe to delete if it is used by $safe_num amount of records
     *
     * @return bool whether image is safe for delete
     */
    public function isSafeForDelete(int $safeAmount = 1): bool;

    /**
     * Removes image from database, and filesystem, if not in use.
     *
     * @param bool $force override safety constraints
     *
     * @return Result
     */
    public function remove(bool $force = false): Result;

    /**
     * Get link to resized photo.
     *
     * @param array $params parameters to pass to route
     *
     * @return string
     */
    public function routeResized(array $params = []): string;

    /**
     * Get link to photo thumbnail.
     *
     * @param array $params parameters to pass to route
     *
     * @return string
     */
    public function routeThumbnail(array $params = []): string;

    /**
     *  Upload and save image.
     *
     * @param UploadedFile $imageFile File from request. e.g. $request->file('image');
     *
     * @return Result
     */
    public static function upload(UploadedFile $imageFile): Result;
}
