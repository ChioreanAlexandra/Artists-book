<?php

namespace MyApp\Controller;

use MyApp\Model\DomainObjects\OrderItem;
use MyApp\Model\DomainObjects\ProductTag;
use MyApp\Model\DomainObjects\Tier;
use MyApp\Model\FormMapper\TierManagement;
use MyApp\Model\FormMapper\UploadProductFormMapper;
use MyApp\Model\Helper\Form\UserField;
use MyApp\Model\Http\Request;
use MyApp\Model\DomainObjects\Product;
use MyApp\Model\Http\Session;
use MyApp\Model\Persistence\Finder\ProductFinder;
use MyApp\Model\Persistence\Finder\TagFinder;
use MyApp\Model\Persistence\Mapper\ProductMapper;
use MyApp\Model\Persistence\PersistenceFactory;
use MyApp\Model\Utilities\DownloadClass;
use MyApp\View\Renderers\HomePageRenderer;
use MyApp\View\Renderers\ProductPageRenderer;
use MyApp\View\Renderers\UploadProductRenderer;

class ProductController
{
    /** @var Session */
    private $session;
    private $request;

    public function __construct(Session $session, Request $request)
    {
        $this->session = $session;
        $this->request = $request;
    }

    /**
     * Calls product finder's findBy method to get all products applying filters
     */
    public function showProducts()
    {
        /** @var ProductFinder $productFinder */
        $productFinder = PersistenceFactory::createFinder(Product::class);
        /** @var array $products */

        $criteria = isset($this->request->getGet()['criteria']) ? $this->request->getGet()['criteria'] : 'title';
        $order = isset($this->request->getGet()['order']) ? $this->request->getGet()['order'] : '';
        $search = isset($this->request->getGet()['search']) ? $this->request->getGet()['search'] : null;
        $products = $productFinder->findBy($criteria, $order, $search);
        $renderer = new HomePageRenderer();
        $renderer->render($products);
    }

    /**
     * Shows product page with a given id
     * @param int $id
     */
    public function showProduct(int $id)
    {
        /** @var ProductFinder $productFinder */
        $productFinder = PersistenceFactory::createFinder(Product::class);
        $product = $productFinder->findById($id);
        /** @var TagFinder $tagFinder */
        $tagFinder = PersistenceFactory::createFinder(Tag::class);
        $tags = $tagFinder->findByProductId($id);
        $renderer = new ProductPageRenderer();
        $renderer->render(['product' => $product, 'tag' => $tags]);
    }

    /**
     * Shows upload page; In case a user is not logged in is redirected to homepage
     */
    public function uploadProductPage()
    {
        if (!$this->session->getSessionValue(UserField::getId())) {
            header("Location:/product/showProducts");
        }
        /** @var TagFinder $tagFinder */
        $tagFinder = PersistenceFactory::createFinder(Tag::class);
        /** @var array $tags */
        $tags = $tagFinder->findAll();
        $renderer = new UploadProductRenderer();
        $renderer->render($tags);
    }

    /**
     * Gets user submitted product data, creates product, creates product tags
     * creates tiers
     */
    public function uploadProduct()
    {
        /** @var UploadProductFormMapper $uploadFormMapper */
        $uploadFormMapper = new UploadProductFormMapper($this->request, $this->session);
        $product = $uploadFormMapper->createProductFromUploadForm();

        /** @var ProductMapper $userMapper */
        $productMapper = PersistenceFactory::createMapper(Product::class);
        $productId = $productMapper->save($product);
        self::uploadProductTag($productId, $product->getTags());
        $tierManagement = new TierManagement();
        self::uploadTiers($tierManagement->createAllTiersForProduct($productId));
        $tierManagement->processThumbnail($product->getThumbnailPath());
        header("Location:/");
    }

    /**
     * Save product's tags for a product with $productId to database
     * @param int $productId
     * @param array $tags
     */
    private function uploadProductTag(int $productId, array $tags)
    {
        $productTag = PersistenceFactory::createMapper(ProductTag::class);
        foreach ($tags as $item) {
            $productTag->save($productId, $item);
        }
    }

    /**
     * Save tiers to database
     * @param array $tiers
     */
    private function uploadTiers(array $tiers)
    {
        $tierMapper = PersistenceFactory::createMapper(Tier::class);
        foreach ($tiers as $item) {
            $tierMapper->save($item);
        }
    }

    /**
     * Save order and start downloading the tier
     * @param int $idProduct
     * @throws \Exception
     */
    public function buyProduct(int $idProduct)
    {
        if (!$this->session->getSessionValue(UserField::getId())) {
            $this->session->setSessionValue('lastViewedProductId', $idProduct);
            header("Location:/user/loginPage");
        }
        $idTierToByBought = $this->request->getPost()['tierId'];
        $idUser = $this->session->getSessionValue(UserField::getId());
        $orderMapper = PersistenceFactory::createMapper(OrderItem::class);
        $orderMapper->save(new OrderItem($idTierToByBought, $idUser, new \DateTime('now')));
        $this->startDownload($this->getFileToByDownloaded($idTierToByBought));
    }

    /**
     * @param string $fileName
     */
    private function startDownload(string $fileName)
    {
        $downloader = new DownloadClass($fileName);
        $downloader->startDownload();
    }

    /**
     * Get tier with the given id and return its path without watermark
     * @param int $id
     * @return string
     */
    private function getFileToByDownloaded(int $id)
    {
        $tierFinder = PersistenceFactory::createFinder(Tier::class);
        /** @var Tier $tier */
        $tier = $tierFinder->findById($id);
        return $tier->getPathWithoutWatermark();
    }

}