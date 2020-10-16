# Bagisto USPS
This extension used for calculating shipping rate with the USPS services.
## Features
- Calculate shipping rate with USPS services.
- Track your shipment by tracking number in Admin Interface.
- Track your shipment by tracking number in Shop Interface.
- [API] Track your shipment by tracking number.
## Requirements
- [Bagisto v1.2](https://github.com/bagisto/bagisto)
- [vinceg/usps-php-api](https://packagist.org/packages/vinceg/usps-php-api)

## Installation

### Install with package folder
1. Unzip all the files to **packages/GGPHP/Shipping**.
2. Open `config/app.php` and add **GGPHP\Shipping\Providers\ShippingServiceProvider::class**.
3. Open `composer.json` of root project and add **"GGPHP\\Shipping\\": "packages/GGPHP/Shipping/src"**.
4. Run the following command
```php
composer dump-autoload
```
5. Go to `https://<your-site>/admin/configuration/sales/carriers`.
6. Make sure that **Marketplace USPS** is active and press save.
7. Go to `https://<your-site>/admin/configuration/sales/shipping` and add shipping address.
8. Run the following command
```php
php artisan vendor:publish --all
```

Your customers are now able to select the new shipping method.

## Example data

### USPS key
- Username: 928GREEN7389

### Shipper address
- Street Address: 8383 Bowman Dr. Los Angeles
- State: CA
- Zip: 90022
- City: Los Angeles
- Country: US

### Recipient address
- Street Address: 10 Fed Ex Pkwy
- State: VA
- Zip: 20171
- City: Herndon
- Country: US

### Tracking number
- LZ661737688US
- 9400111298370718571488

## Guide

### Track your shipment by tracking number in Admin Interface.
- Go to `https://<your-site>/admin/sales/tracking/{tracking-number}`.

### Track your shipment by tracking number in Shop Interface.
- Go to `https://<your-site>/customer/account/orders/{order-id}/tracking`.

### Get shipment infomations
- Use `uspsTrackById($trackingIds)` method to get shipment infomations with `trackingIds` are tracking number array.
