<?php use MyApp\Model\Helper\Form\ImageFields;?>

<?php if (!isset($productList)): return; endif;?>
<div class="container">
    <h2>Image Gallery</h2>
    <div align="right">
        <form action="/product/showProduct" method="get" >
            <input class="form-control" type="text" placeholder="Search" aria-label="Search" name="search">
            <select name="criteria" >
                <option value="title">Title</option>
                <option value="description">Description</option>
                <option value="capture_data">Capture data</option>
            </select>
            <select name="order" >
                <option value="asc">Ascending</option>
                <option value="desc">Descending</option>
            </select>
            <input class="btn btn-primary" type="submit" value="Search">
        </form>
    </div>

    <div class="row">
        <?php /** @var $product \MyApp\Model\DomainObjects\Product */?>
        <?php foreach ($productList as $product):?>
        <div class="col-lg-4">
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


