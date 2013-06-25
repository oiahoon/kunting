MoxieManager
============

Croogo 1.5 plugin for MoxieManager (moxiemanager.com - requires license) replaces core FileManager::attachments.

Also automatically integrates with Ckeditor core plugin and my recently 
released [Tinymce 4 plugin](https://github.com/phpMagpie/Tinymce) for uploading/inserting files and images.

# MoxieManager

Plugin for integrating [MoxieManager](http://moxiemanager.com/) (requires license) into [Croogo](http://croogo.org).  Requires Croogo v1.5 or higher.  

## Installation

1. Clone repository to /app/Plugin/MoxieManager, and activate the plugin from your admin panel.
2. Deactivate any other File Manager plugins
3. Create a symlink in /app/webroot called MoxieManager to ../Plugin/MoxieManager/webroot/moxiemanager
4. Buy a license and enter the key into first setting of ../Plugin/MoxieManager/webroot/moxiemanager/config.php 
5. Edit ../Config/croogo.php, adding checkAgent = false param to Session configuration
6. Set ExternalAuthenticator.secret_key in config.php and $secretKey in MoxieManagerController.php to the same value 
7. Also in MoxieManagerController.php, change filesystem.local.wwwroot to your full path to webroot

The third step bypasses CakePHP's plugin routing when accessing MoxieManager.

On my Redhat Linux server I run the following as root:

1. cd /app/webroot
2. ln -s ../Plugin/MoxieManager/webroot/moxiemanager
3. chown -h %youruser%:%yourgroup% MoxieManager

## Configuration

I've got it set to use ../webroot/uploads as the home folder and have configured an ExternalAuthentication which 
makes an AJAX call to /moxie_manager/moxie_manager/auth to check if an active login session is available.  

In order for the ExternalAuthentication to work you must follow step 5 of the installation instructions or the 
SESSION will be expired each time you try to authenticate due to the userAgent being different.

If you edit the /moxie_manager/moxie_manager/auth action you could change the home path for each user if required, 
along with other settings.

See http://www.moxiemanager.com/documentation/index.php/Configuration for full list of config options.

## Still to do

1. Make Media > Attachments link open MoxieManager inline rather than present a Browse button to open an inline popup
2. Move config options to bootstrap for easier management
