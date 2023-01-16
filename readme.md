# Abandoned !!!

Please use https://git.magexo.cz/magexo-modules-v2/module-shop-by-brand-graph-ql-extended with version of 2.45.x or highter
magexo/module-shop-by-brand-graph-ql-extended:^2.45

# ShopByBrand Extended

Module for Magento 2

**ShopByBrand  Extended** - ShopByBrand extension for Amasty, removes base media url from image urls,
fixes some GQL issues in version Amasty ShopByBrand extension in version >= 2.13.0.

## Dependencies

### ShopByBrand GraphQL Extended

GQL extentions from StorefrontX. >= 1.0.0
**Composer module name: storefront-x/magento-module-shop-by-brand-graphql-extended**

### Amasty Shop By Brand 

Brand extension by Amasty. >=2.13.0
**Composer module name: amasty/module-shop-by-brand**

### Amasty Shop By Brand Base

Base extension for brands. >= 2.16.0
**Composer module name: amasty/module-shop-by-base**



## License

The module is licensed under the MIT license.

### Fix graphql error:
```bash
"debugMessage": "str_replace(): Argument #3 ($subject) must be of type array|string, null given",
```
```bash
src/vendor/amasty/module-shop-by-brand-graphql/Model/Resolver/BrandList::prepareBrands()
```

```php
$brand['image'] = str_replace($baseUrl, '', $brand['image']);
$brand['img'] = str_replace($baseUrl, '', $brand['img']);
$brand['url'] = str_replace($baseUrl, '', $brand['url']);
```
```php
$brand['image']
$brand['img']
``` 
returns null, string value is expected

### Remove base media url from image urls
