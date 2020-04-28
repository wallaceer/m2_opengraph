<?php
namespace Ws\Opengraph\Block;

/**
 * Class Product
 * @package Ws\Opengraph\Block
 */
class Product extends \Magento\Framework\View\Element\Template
{

    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    protected $_productloader;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $_registry;

    /**
     * @var \Magento\Catalog\Helper\Image
     */
    protected $_imageHelper;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var \Ws\Opengraph\Helper\Data
     */
    protected $_customData;

    /**
     * Product constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Catalog\Model\ProductFactory $_productloader
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Catalog\Helper\Image $imageHelper
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Catalog\Model\ProductFactory $_productloader,
        \Magento\Framework\Registry $registry,
        \Magento\Catalog\Helper\Image $imageHelper,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Ws\Opengraph\Helper\Data $customData

    ) {
        $this->_productloader = $_productloader;
        $this->_registry = $registry;
        $this->_imageHelper = $imageHelper;
        $this->_storeManager = $storeManager;
        $this->_customData = $customData;
        parent::__construct($context);
    }

    /**
     * @return mixed
     */
    public function getCurrentCategory()
    {
        return $this->_registry->registry('current_category');
    }

    /**
     * @return mixed
     */
    public function getCurrentProduct()
    {
        return $this->_registry->registry('current_product');
    }


    /**
     * @return string
     */
    public function getLoadProduct()
    {
        try{
            $productId = $this->getCurrentProduct()->getId();
        }
        catch( NoSuchEntityException $e){
            return __("Product not found!");
        }
        return $this->_productloader->create()->load($productId);
    }

    /**
     * @param $imageType {product_base_image(265×265), product_page_image_large (700×700), product_page_image_medium (700×700)}
     * @return mixed
     */
    public function getProductImage($imageType){
        return $this->_imageHelper->init($this->getLoadProduct(), $imageType)->getUrl();;
    }

    /**
     * Get store identifier
     *
     * @return  int
     */
    public function getStoreId()
    {
        return $this->_storeManager->getStore()->getId();
    }

    /**
     * Get website identifier
     *
     * @return string|int|null
     */
    public function getWebsiteId()
    {
        return $this->_storeManager->getStore()->getWebsiteId();
    }

    /**
     * Get Store code
     *
     * @return string
     */
    public function getStoreCode()
    {
        return $this->_storeManager->getStore()->getCode();
    }

    /**
     * Get Store name
     *
     * @return string
     */
    public function getStoreName()
    {
        return $this->_storeManager->getStore()->getName();
    }

    /**
     * Get current url for store
     *
     * @param bool|string $fromStore Include/Exclude from_store parameter from URL
     * @return string
     */
    public function getStoreUrl($fromStore = true)
    {
        return $this->_storeManager->getStore()->getCurrentUrl($fromStore);
    }

    /**
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getCurrentCurrencyCode(){
        return $this->_storeManager->getStore()->getCurrentCurrency()->getCode();
    }

    /**
     * Check if store is active
     *
     * @return boolean
     */
    public function isStoreActive()
    {
        return $this->_storeManager->getStore()->isActive();
    }

    /**
     * @return \Magento\Framework\App\Config\ScopeConfigInterface|mixed
     */
    public function shopTitle(){
        return $this->_customData->getShopTitle();
    }

}