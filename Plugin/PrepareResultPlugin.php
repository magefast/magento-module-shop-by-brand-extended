<?php
declare(strict_types=1);

namespace StorefrontX\ShopByBrandExtended\Plugin;

use StorefrontX\ShopByBrandExtended\Model\RemoveBaseMediaUrl;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;
use StorefrontX\ShopByBrandGraphQlExtended\Model\Resolver\GetAmBrandById;

class PrepareResultPlugin
{
    public function __construct(
        private readonly StoreManagerInterface $storeManager,
        private readonly RemoveBaseMediaUrl    $removeBaseMediaUrl
    ) {
    }

    /**
     * @throws NoSuchEntityException
     */
    public function afterPrepareResult(
        GetAmBrandById $subject,
        array          $result,
        $setting,
        $brandOption
    ): array {
        /** @phpstan-ignore-next-line */ // Call to an undefined method StoreInterface::getBaseUrl()
        $baseMediaUrl = $this->storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        if ($baseMediaUrl) {
            $this->removeBaseMediaUrl->execute($result, $baseMediaUrl);
        }
        return $result;
    }
}
