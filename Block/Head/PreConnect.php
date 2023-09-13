<?php

declare(strict_types=1);

namespace Wage\Preload\Block\Head;

class PreConnect extends PreloadBase
{
    protected $config_xml_path = 'wage_preload/general/urls_to_preconnect';
    protected $href_pattern = ':url:';
    protected $preload_template = '<link rel="preconnect" href=":url:" crossorigin>';
    protected $empty_message = "\n<!-- PreConnect: No Url provided -->\n";
    protected $preload_message = "\n<!-- PreConnect -->\n";
}
