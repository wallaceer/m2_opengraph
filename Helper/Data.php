<?php

namespace Ws\Opengraph\Helper;

/**
 * Class Data
 * @package Ws\Opengraph\Helper
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    /**
     * @param string $path
     * @return \Magento\Framework\App\Config\ScopeConfigInterface|mixed
     */
    public function getConfig($path = '')
    {
        if ($path) return $this->scopeConfig->getValue($path, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return $this->scopeConfig;
    }


    /**
     * @return \Magento\Framework\App\Config\ScopeConfigInterface|mixed
     */
    public function getShopTitle(){
        return $this->getConfig('design/head/default_title');
    }

    /**
     * @description Get Facebook meta tags template from custom module or magento 2 default module
     * @return string
     */
    public function getTemplate()
    {
        if ($this->scopeConfig->isSetFlag('ws_opengraph/ws_general/ws_opengraph_enable')) {
            $template =  'Ws_Opengraph::general.phtml';
        } else {
            $template = 'Magento_Catalog::product/view/opengraph/general.phtml';
        }

        return $template;
    }

}