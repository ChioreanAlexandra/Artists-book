<?php $data = isset($data) && is_array($data) ? $data : []; ?>
<?php if (!isset($data['product'])): return; endif;?>
<?php if (!isset($data['tag'])): return; endif;?>

<?php /** @var $product \MyApp\Model\DomainObjects\Product */?>
<?php $product=$data['product']; ?>
<?php $tags=$data['tag']; ?>
<div class="content">
    <h1>Product page</h1>
    <div class="col-xs-4">
        <div class="thumbnail">
            <a href="/product/showProduct/<?php echo $product->getId();?>">
                <img src="/<?php echo $product->getThumbnailPath();?>" alt="<?php echo $product->getTitle(); ?>" style="width:100%">
                <div class="caption">
                    <p><?php echo $product->getTitle();?></p>
                </div>
            </a>
        </div>
        <div>
        <?php
        foreach ($tags as $item):
            echo $item->getTagName().'<br>';
            endforeach;?>
        </div>
    </div>


    <div class="col-xs-8">
        <?php $tiers=$product->getTiers();?>
        <?php if (!isset($tiers)): return; endif;?>
        <?php foreach ($tiers as $tier): ?>
            <a class="btn btn-primary" href="" role="button"><?php echo "Preview ". $tier->getSize() ." tier"?></a>
        <?php endforeach; ?>
        <a class="btn btn-primary" href="/product/buyProduct/<?php echo $product->getId();?>" role="button">Buy</a>
    </div>
    <form action="/product/buyProduct/<?php echo $product->getId();?>" method="post">
        <select name="tierId">
            <option value="<?php echo $tiers['large']->getId();?>">Large tier</option>
            <option value="<?php echo $tiers['medium']->getId();?>">Medium tier</option>
            <option value="<?php echo $tiers['small']->getId();?>">Small tier</option>
        </select>
        <input type="submit" value="Buy">

    </form>

</div>

<div style="clear: both;"></div>
</div>

</div>

