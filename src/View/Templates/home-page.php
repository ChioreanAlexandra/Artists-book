
<div class="container">
    <h2>Image Gallery</h2>

    <div class="row">
        <?php /** @var $product \MyApp\Model\DomainObjects\Product */?>
        <?php foreach ($productList as $product):?>
        <div class="col-md-4">
            <div class="thumbnail">
                <
                    <a href="/product/showProduct/<?php echo $product->getId();?>">
                    <img src="/<?php echo $product->getThumbnailPath();?>" alt="<?php echo $product->getTitle(); ?>" style="width:100%">
                    <div class="caption">
                        <p><?php echo $product->getTitle();?></p>
                    </div>
                </a>
            </div>
        </div>
        <?php endforeach; ?>

    </div>
</div>


