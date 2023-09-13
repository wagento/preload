<?php

declare(strict_types=1);

namespace Wage\Preload\Block\Head;

class PreloadCss extends PreloadBase
{
    protected $config_xml_path = 'wage_preload/general/css_to_preload';
    protected $href_pattern   = ':url:';
    protected $preload_template = '<link rel="preload" as="style" href=":url:" crossorigin >';
    protected $empty_message = "\n<!-- CSS Preload: No css provided -->\n";
    protected $preload_message = "\n<!-- Preload CSS -->\n";
}
