<?php

declare(strict_types=1);

namespace Wage\Preload\Block\Head;

use Magento\Store\Model\ScopeInterface;
use Magento\Framework\View\Element\Context;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * PreloadBase class
 */
class PreloadBase extends \Magento\Framework\View\Element\AbstractBlock
{
    /**
     * @var string
     */
    protected $config_xml_path = "";

    /**
     * @var string
     */
    protected $href_pattern   = "";

    /**
     * @var string
     */
    protected $preload_template = "";

    /**
     * @var string
     */
    protected $empty_message = "\n<!-- Preload: Not Configured -->\n";

    /**
     * @var string
     */
    protected $preload_message = "\n<!-- Preload Assets -->\n";

    /**
     * @var Json
     */
    protected Json $json;

    /**
     * @var ScopeConfigInterface
     */
    protected ScopeConfigInterface $scopeConfig;

    /**
     * @param Context              $context
     * @param ScopeConfigInterface $scopeConfig
     * @param Json                 $json
     * @param array                $data
     */
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig,
        Json $json,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->scopeConfig = $scopeConfig;
        $this->json = $json;
    }

    /**
     * retrieve assets from config
     */
    protected function getAssets()
    {
        $config_string = $this->scopeConfig->getValue($this->config_xml_path, ScopeInterface::SCOPE_STORE);
        if ($config_string && is_string($config_string)) {
            return $this->json->unserialize($config_string);
        }

        return null;
    }

    /**
     * Produce and return block's html output
     *
     * @return string
     */
    protected function _toHtml() {
        $html = '';
        $assets = $this->getAssets();

        if (empty($assets)) {
            return $this->empty_message;
        }

        if (empty($this->href_pattern) || empty($this->preload_template)) {
            return "\n<!-- Missing template or pattern -->\n";
        }
        else {
            $html .= $this->preload_message;
        }

        foreach ($assets as $asset) {
            // support both absolute url and dynamic path to assets on server
            if (filter_var($asset['css_class'], FILTER_VALIDATE_URL)) {
                $assetUrl = $asset['css_class'];
            }
            else {
                $assetUrl = $this->_assetRepo->getUrl($asset['css_class']);
            }
            $html .= $this->renderLinkTemplate($assetUrl);
        }

        return $html;
    }

    /**
     * @param string $assetUrl
     * @return string
     */
    protected function renderLinkTemplate($assetUrl)
    {
        return str_replace(
            [$this->href_pattern],
            [$assetUrl],
            $this->preload_template
        );
    }
}
