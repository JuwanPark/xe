<?php
if(!defined("__XE__")) exit();

/**
 * @file highlightsjs.addon.php
 * @author Juwan Park (park_juwan@naver.com), highlights.js
 * @brief highlights.js
 * */

if($called_position == 'before_module_proc'){
	$css_location = "";
	$js_location = "";

	if(!$addon_info->hostlink) { $hostlink = "cdnjs";
	} else { $hostlink = $addon_info->hostlink; }

	if(!$addon_info->syntax_style) { $syntax_style = "default";
	} else { $syntax_style = $addon_info->syntax_style; }

	if($addon_info->line_number == "yes" || !$addon_info->line_number) { $linenum = true;
	} else { $linenum = false; }

	switch ($hostlink) {
		case "cdnjs":
			$css_location = "//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.9.0/styles/" . $syntax_style . ".min.css";
			$js_location = "//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.9.0/highlight.min.js";
			break;
		case "jsdelivr":
			$css_location = "//cdn.jsdelivr.net/highlight.js/9.9.0/styles/" . $syntax_style . ".min.css";
			$js_location = "//cdn.jsdelivr.net/highlight.js/9.9.0/highlight.min.js";
			break;
		case "direct":
			$css_location = "./addons/highlightsjs/custom/styles/" . $syntax_style . ".css";
			$js_location = "./addons/highlightsjs/custom/highlight.pack.js";
			break;
	}

	// add css and js
	Context::addHtmlHeader("<!-- Start of highlights.js addon -->");

	Context::addHtmlHeader("<link rel=\"stylesheet\" href=\"" .$css_location . "\" />");
	if ($linenum) { Context::addHtmlHeader("<link rel=\"stylesheet\" href=\"./addons/highlightsjs/line-numbers.css\"></script>"); }
	if ($addon_info->ngc_import == 'yes') {
		Context::addHtmlHeader("<link rel=\"stylesheet\" href=\"./addons/highlightsjs/ngc_import.css\" />");
	}
	Context::addHtmlHeader("<script src=\"" . $js_location . "\"></script>");
	if ($linenum) { Context::addHtmlHeader("<script src=\"./addons/highlightsjs/highlightjs-line-numbers.min.js\"></script>"); }
	
	Context::addHtmlHeader("<script>");
	if ((int)$addon_info->tabsize > 0) {
		Context::addHtmlHeader("	hljs.configure({tabReplace: '" . str_repeat(" ", (int)$addon_info->tabsize) . "'})");
	}
	Context::addHtmlHeader("	hljs.initHighlightingOnLoad();");
	if ($linenum) { Context::addHtmlHeader("	hljs.initLineNumbersOnLoad();"); }
	Context::addHtmlHeader("</script>");
	if ($linenum) { Context::addHtmlHeader("<script src=\"./addons/highlightsjs/line-numbers-block.js\"></script>"); }

	// end
	Context::addHtmlHeader("<!-- End of highlights.js addon -->");
	Context::addHtmlHeader("\n");
}
/* End of file highlightsjs.addon.php */
/* Location: ./addons/highlightsjs/highlightsjs.addon.php */
?>
