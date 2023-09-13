<?php

declare(strict_types=1);

namespace Wage\Preload\Block\Head;

class PreloadScript extends PreloadBase
{
    protected $config_xml_path = 'wage_preload/general/scripts_to_preload';
    protected $href_pattern   = ':url:';
    protected $preload_template = '<link rel="preload" as="script" href=":url:" >';
    protected $empty_message = "\n<!-- Script Preload: No script provided -->\n";
    protected $preload_message = "\n<!-- Preload Script -->\n";
}
