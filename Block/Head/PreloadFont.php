<?php

declare(strict_types=1);

namespace Wage\Preload\Block\Head;

class PreloadFont extends PreloadBase
{
    protected $config_xml_path = 'wage_preload/general/fonts_to_preload';
    protected $href_pattern   = ':url:';
    protected $preload_template = '<link rel="preload" as="font" crossorigin href=":url:" >';
    protected $empty_message = "\n<!-- Font Preload: No font provided -->\n";
    protected $preload_message = "\n<!-- Preload Font -->\n";
}
