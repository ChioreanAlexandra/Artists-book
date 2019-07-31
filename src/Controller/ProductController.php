<?php

namespace MyApp\Controller;
use MyApp\Model\FormMapper\TierFactory;
use MyApp\Model\FormMapper\UploadProductFormMapper;
use MyApp\Model\Http\Request;
use MyApp\Model\DomainObjects\Product;
use MyApp\Model\Http\RequestFactory;
use MyApp\Model\Http\Session;
use MyApp\Model\Http\SessionFactory;
use MyApp\Model\Persistence\Finder\ProductFinder;
use MyApp\Model\Persistence\Finder\TagFinder;
use MyApp\Model\Persistence\Mapper\ProductMapper;
use MyApp\Model\Persistence\PersistenceFactory;
use MyApp\View\Renderers\HomePageRenderer;
use MyApp\View\Renderers\ProductPageRenderer;
use MyApp\View\Renderers\UploadProductRenderer;

class ProductController
{
    /** @var array  */
    public static function showProducts()
    {
        /** @var ProductFinder $productFinder */
        $productFinder = PersistenceFactory::createFinder(Product::class);
        /** @var array $products */
        $products = $productFinder->findAll();
        $renderer=new HomePageRenderer();
        $renderer->render($products);
    }

    public static function showProduct()
    {
        $renderer=new ProductPageRenderer();
        $renderer->render();
//        ProductPageRenderer::render();
    }

    public static function uploadProductPage()
    {
        /** @var TagFinder $tagFinder */
        $tagFinder = PersistenceFactory::createFinder(Tag::class);
        /** @var array $tags */
        $tags = $tagFinder->findAll();
        $renderer=new UploadProductRenderer();
        $renderer->render($tags);
    }

    private static function uploadTiers(array $tiers)
    {
        $tierMapper = PersistenceFactory::createMapper(Tier::class);
        foreach ($tiers as $item)
        {
            $tierMapper->save($item);
        }
    }
    public static function uploadProduct()
    {

        $request=RequestFactory::createRequest();
        $session=SessionFactory::createSession();
        $error=[];
        /** @var UploadProductFormMapper $uploadFormMapper */
        $uploadFormMapper=new UploadProductFormMapper($request,$session);
        $product=$uploadFormMapper->createProductFromUploadForm();
        /** @var ProductMapper $userMapper */
        $productMapper = PersistenceFactory::createMapper(Product::class);
        $productId=$productMapper->save($product);
        $tierFactory=new TierFactory();
        self::uploadTiers($tierFactory->createAllTiersForProduct($productId));
        //header("Location:/user/profile/");
    }

    public static function buyProduct()
    {
        echo 'on buy';
        //require_once("src/View/Templates/home-page.php");git +
    }

}