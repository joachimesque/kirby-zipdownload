# Kirby ZipDownload

This plugin provides basic capacity to select & download multiple files as a zip.

## Version

0.1 : initial release

## Installation

1. Copy the plugin folder to `site/plugins`.
2. Make `kirby-zipdownload/temp` writable.
3. Setup your server's `cron` file to execute `kirby-zipdownload/cron.php` regularly.
4. Modify your template files and customize the snippets to your needs.

## Usage

There's two way to use the plugin.

### The simple way

Use the `asset_gallery` snippet, it's adapted from Kirby default theme's Projects template.

### The custom way

Use the `btn_dl` snippet where you want it. It's got an ID attribute so it's better if you don't reuse it.    

Then, in the loop calling all the images/documents, use the snippet `checkbox`.

### Going further

The checkboxes can be styled and scripted at will, it's the checked/unchecked state that counts when the form is sent (via a POST request). You can hide the checkboxes and check them in JavaScript through other means.

## TODO

- i18n of the error message
- Using smaller versions of the images to fill the zip through the thumbnail API        
  (or ask the content editors to upload smaller images?)
- Basic CSS styles

## Copyright

© 2016 Joachim Robert

## License

CREATIVE COMMONS Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)

https://creativecommons.org/licenses/by-sa/3.0/

