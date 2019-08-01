<?php use MyApp\Model\Helper\Form\ImageFields;?>
<?php if (!isset($productList)): return; endif;?>
<div class="container">
    <h2>Image Gallery</h2>
    <div align="right">
        <form action="/product/showProduct" method="post" >
            <select name="criteria" >
                <option>Title</option>
                <option>Description</option>
                <option>Capture data</option>
                <option>Price</option>
            </select>
            <select name="order" >
                <option>Ascending</option>
                <option>Descending</option>
            </select>
            <input class="btn btn-primary" type="submit" value="Search">
        </form>
    </div>

    <div class="row">
        <?php /** @var $product \MyApp\Model\DomainObjects\Product */?>
        <?php foreach ($productList as $product):?>
        <div class="col-md-4">
            <div class="thumbnail">
                    <a href="/product/showProduct/<?php echo $product->getId();?>">
                    <img src="/<?php echo ImageFields::IMAGES_DIRECTORY.$product->getThumbnailPath();?>" alt="<?php echo $product->getTitle(); ?>" style="width:100%">
                    <div class="caption">
                        <p><?php echo $product->getTitle();?></p>
                    </div>
                </a>
            </div>
        </div>
        <?php endforeach; ?>

    </div>
</div>


