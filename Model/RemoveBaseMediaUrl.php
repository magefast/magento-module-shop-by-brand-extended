<?php
declare(strict_types=1);

namespace StorefrontX\ShopByBrandExtended\Model;

use Amasty\ShopbyBrand\Model\Brand\BrandData;

class RemoveBaseMediaUrl
{
    private const MEDIA_PREFIX = "/media";

    private const IMAGE_ATTRIBUTES = [
        'image',
        'img'
    ];

    /**
     * @param array|BrandData $item
     * @param string $baseMediaUrl
     * @return void
     */
    public function execute(array|BrandData &$item, string $baseMediaUrl): void
    {
        foreach (self::IMAGE_ATTRIBUTES as $attr) {
            $item[$attr] = str_replace($baseMediaUrl, '', $item[$attr]);
            if (!str_contains($item[$attr], self::MEDIA_PREFIX)) {
                $item[$attr] = str_replace('media/', '', $item[$attr]); //fix for amBrandById
                $item[$attr] = self::MEDIA_PREFIX . $item[$attr];
            }
        }
    }
}
