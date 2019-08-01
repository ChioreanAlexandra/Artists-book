<?php

namespace MyApp\Controller;

use MyApp\Model\DomainObjects\OrderItem;
use MyApp\Model\DomainObjects\ProductTag;
use MyApp\Model\FormMapper\TierFactory;
use MyApp\Model\FormMapper\UploadProductFormMapper;
use MyApp\Model\Helper\Form\UserField;
use MyApp\Model\Http\Request;
use MyApp\Model\DomainObjects\Product;
use MyApp\Model\Http\Session;
use MyApp\Model\Persistence\Finder\ProductFinder;
use MyApp\Model\Persistence\Finder\TagFinder;
use MyApp\Model\Persistence\Mapper\ProductMapper;
use MyApp\Model\Persistence\PersistenceFactory;
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
        $this->session=$session;
        $this->request=$request;
    }

    /** @var array */
    public function showProducts()
    {
        /** @var ProductFinder $productFinder */
        $productFinder = PersistenceFactory::createFinder(Product::class);
        /** @var array $products */
        $products = $productFinder->findAll();
        $renderer = new HomePageRenderer();
        $renderer->render($products);
    }

    public function showProduct(int $id)
    {
        /** @var ProductFinder $productFinder */
        $productFinder = PersistenceFactory::createFinder(Product::class);
        $product = $productFinder->findById($id);
        /** @var TagFinder $tagFinder */
        $tagFinder= PersistenceFactory::createFinder(Tag::class);
        $tags=$tagFinder->findByProductId($id);
        $renderer = new ProductPageRenderer();
        $renderer->render(['product' => $product, 'tag'=>$tags]);
//        ProductPageRenderer::render();
    }

    public  function uploadProductPage()
    {
        if(!$this->session->getSessionValue(UserField::getId()))
        {
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
     * gets user submitted product data, creates product, creates product tags
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
        $tierFactory = new TierFactory();
        self::uploadTiers($tierFactory->createAllTiersForProduct($productId));
        header("Location:/product/showProducts/");
    }

    private  function uploadProductTag(int $productId, array $tags)
    {
        $productTag = PersistenceFactory::createMapper(ProductTag::class);
        foreach ($tags as $item) {
            $productTag->save($productId, $item);
        }
    }

    private function uploadTiers(array $tiers)
    {
        $tierMapper = PersistenceFactory::createMapper(Tier::class);
        foreach ($tiers as $item) {
            $tierMapper->save($item);
        }
    }

    public function buyProduct(int $idProduct)
    {

        if(!$this->session->getSessionValue(UserField::getId()))
        {
            $this->session->setSessionValue('lastViewedProductId',$idProduct);
            header("Location:/user/loginPage");
        }
        $idTierToByBought=$this->request->getPost()['tierId'];
        $idUser=$this->session->getSessionValue(UserField::getId());
        $orderMapper=PersistenceFactory::createMapper(OrderItem::class);
        $orderMapper->save(new OrderItem($idTierToByBought,$idUser,new \DateTime('now')));
        //require_once("src/View/Templates/home-page.php");git +
    }

}