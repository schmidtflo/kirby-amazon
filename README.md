# KirbyText Extension: Amazon

A Kirbytag which let you integrate Amazon-products in your website. It also chaches the product picture, because Amazon doesn't let you retrive it via HTTPS so you have to cache it locally to send it to your users via HTTPS.

## Requirements

You need just an Amazon API account via the Amazon Partnernet.

## Installation

Just drop the `amazon`-Folder in the plugin directory (`site/plugins`) and have a look in the settings file.

## Usage

Get the Amazon-ID of the product (for example `B00VL55Q8O`).

You can use it now as a normal Kirbytag: `(amazon: B00VL55Q8O)`.

## Customization

If nessesary, you can edit the `amazon.php` at the bottom to change the HTML DOM. 

## Credits

This software is under MIT license.

Uses aws_signed_request.php by Ulrich Mierendorff.
