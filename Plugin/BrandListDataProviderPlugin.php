<?php
declare(strict_types=1);

namespace StorefrontX\ShopByBrandExtended\Plugin;

use Amasty\ShopbyBrand\Model\Brand\BrandListDataProvider;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;
use StorefrontX\ShopByBrandExtended\Model\RemoveBaseMediaUrl;

class BrandListDataProviderPlugin
{

    private const NOT_NULLABLE_ATTRIBUTES = [
        'image',
        'img',
        'url'
    ];

    public function __construct(
        private readonly StoreManagerInterface $storeManager,
        private readonly RemoveBaseMediaUrl $removeBaseMediaUrl
    ) {
    }

    /**
     * @throws NoSuchEntityException
     */
    public function afterGetList(
        BrandListDataProvider $subject,
        array                 $result,
        int                   $storeId,
        array                 $filterParams,
        ?string               $sortBy
    ): array {
        /** @phpstan-ignore-next-line */ // Call to an undefined method StoreInterface::getBaseUrl()
        $baseMediaUrl = $this->storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);

        foreach ($result as &$brand) {
            foreach (self::NOT_NULLABLE_ATTRIBUTES as $attr) {
                if ($brand[$attr] === null) {
                    $brand[$attr] = "";
                }
            }

            if ($baseMediaUrl) {
                $this->removeBaseMediaUrl->execute($brand, $baseMediaUrl);
            }
        }
        return $result;
    }
}
