<?php

declare(strict_types=1);

use Bkwld\Croppa\Filters\BlackWhite;
use Bkwld\Croppa\Filters\Blur;
use Bkwld\Croppa\Filters\Darkgray;
use Bkwld\Croppa\Filters\Negative;
use Bkwld\Croppa\Filters\OrangeWarhol;
use Bkwld\Croppa\Filters\TurquoiseWarhol;

return [
    /*
    |-----------------------------------------------------------------------------
    | Image source and crop destination
    |-----------------------------------------------------------------------------
    */

    /*
     * The disk where source images are found. This is generally where your
     * admin stores uploaded files.
     */
    'src_disk' => 'public',

    /*
     * The disk where cropped images will be saved.
     */
    'crops_disk' => 'public',

    /*
     * Maximum number of sizes to allow for a particular source file. This is to
     * limit scripts from filling up your hard drive with images. Set to false or
     * comment out to have no limit. This is disabled by default because the
     * `signing_key` is a better prevention of malicious usage.
     *
     * @var integer | boolean
     */
    'max_crops' => false,

    /*
    |-----------------------------------------------------------------------------
    | URL parsing and generation
    |-----------------------------------------------------------------------------
    */

    /*
     * A regex pattern that is applied to both the src url passed to
     * `Croppa::url()` as well as the crop path received when handling a crop
     * request to find the path to the src image relative to both the src_disk
     * and crops_disks. This path will be used to find the source image in the
     * src_disk. The path component of the regex must exist in the first captured
     * subpattern. In other words, in the `preg_match` $matches[1].
     *
     * @var string
     */
    'path' => 'storage/(.*)$',

    /*
     * A regex pattern that works like `path` except it is only used by the
     * `Croppa::url($url)` generator function. If the $path url matches, it is
     * passed through with no Croppa URL suffixes added. Thus, it will not be
     * cropped. This is designed, in particular, for animated gifs which lose
     * animation when cropped.
     *
     * @var string
     */
    'ignore' => '\.(gif|GIF)$',

    /*
     * Reject attempts to maliciously create images by signing the generated
     * request with a hash based on the request parameters and this signing key.
     * Set to 'app.key' to use Laravel's `app.key` config, any other string to use
     * THAT as the key, or false to disable.
     *
     * If you are generating URLs outside of `Croppa::url()`, like the croppa.js
     * module, you can disable this feature by setting the `signing_key` config
     * to false.
     *
     * @var string | boolean
     */
    'signing_key' => 'app.key',

    /*
     * The PHP memory limit used by the script to generate thumbnails. Some
     * images require a lot of memory to perform the resize, so you may increase
     * this memory limit.
     */
    'memory_limit' => '128M',

    /*
    |-----------------------------------------------------------------------------
    | Image settings
    |-----------------------------------------------------------------------------
    */

    /*
     * The jpeg quality of generated images. The difference between 100 and 95
     * usually cuts the file size in half. Going down to 70 looks ok on photos
     * and will reduce filesize by more than another half but on vector files
     * there is noticeable aliasing.
     *
     * @var integer
     */
    'quality' => 75,

    /*
     * Turn on interlacing to make progessive jpegs.
     *
     * @var boolean
     */
    'interlace' => true,

    /*
     * If the source image is smaller than the requested size, allow Croppa to
     * scale up the image. This will reduce in quality loss.
     *
     * @var boolean
     */
    'upsize' => true,

    /*
     * Filters for adding additional GD effects to an image and using them as parameter
     * in the croppa image slug.
     *
     * @var array
     */
    'filters' => [
        'gray' => BlackWhite::class,
        'darkgray' => Darkgray::class,
        'blur' => Blur::class,
        'negative' => Negative::class,
        'orange' => OrangeWarhol::class,
        'turquoise' => TurquoiseWarhol::class,
    ],
];
