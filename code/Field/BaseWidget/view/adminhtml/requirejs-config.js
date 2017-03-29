/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
 var config = {
 	map: {
 		"*": {
 			fieldBaseTinyMceWysiwygSetup: "Field_BaseWidget/js/wysiwyg/tiny_mce/setup",
 			fieldBaseBootstrap: "Field_BaseWidget/js/bootstrap336/bootstrap",
 			fieldBaseColorPicker: "Field_BaseWidget/js/jquery/jquery.colorpicker",
 			fieldBaseElfinderSetup: "Field_BaseWidget/js/elfinder/js/elfinder.min",
 			fieldBaseCommon: "Field_BaseWidget/js/common",
 			fieldBaseJqueryUi: "Field_BaseWidget/js/jquery/ui/jquery-ui.min",
 			fieldBasejQueryCookie: "Field_BaseWidget/js/jquery/jquery.cookie",
 			fieldJqueryNestable: "Field_BaseWidget/js/jquery/jquery.nestable",
 			fieldMageWidget: "Field_BaseWidget/js/builder/widget",
			fieldPageBuilder: "Field_BaseWidget/js/builder/script",
			fieldBootBox: "Field_BaseWidget/js/jquery/bootbox.min",
			jqueryUi: "jquery/jquery-ui"
 		}
 	},
 	/*
    paths: {
        "jquery/ui": "jquery/jquery-ui"
    },*/
    deps: [
    	'mage/adminhtml/wysiwyg/widget'
    ]
 };