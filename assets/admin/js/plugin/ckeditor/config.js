/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	config.extraPlugins = 'youtube';
	config.allowedContent = true;
	config.extraAllowedContent = 'p(*){*}[*]';
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';


	// Make dialogs simpler.
	config.removeDialogTabs = 'image:advanced;link:advanced';

   	config.filebrowserBrowseUrl = '/file_manager/browse.php?type=files';
   	config.filebrowserImageBrowseUrl = '/file_manager/browse.php?type=images';
   	config.filebrowserFlashBrowseUrl = '/file_manager/browse.php?type=flash';
   	config.filebrowserUploadUrl = '/file_manager/upload.php?type=files';
   	config.filebrowserImageUploadUrl = '/file_manager/upload.php?type=images';
   	config.filebrowserFlashUploadUrl = '/file_manager/upload.php?type=flash';	
};
