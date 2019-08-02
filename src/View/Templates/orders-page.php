<?php use MyApp\Model\Helper\Form\ImageFields;?>
<?php if (!isset($tierList)): return; endif;?>
<div class="container">
    <h2>Order products Gallery</h2>

        <?php /** @var $tier \MyApp\Model\DomainObjects\Tier */ ?>
        <?php foreach ($tierList as $tier): ?>
            <div class="card" style="margin: 20px">
                <img class="card-img-top" src="/<?php echo ImageFields::IMAGES_DIRECTORY.$tier->getPathWithWatermark() ?>" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text" style="color: azure; font-weight: bold;"><?php echo 'Size: '.$tier->getSize() . '<br>Price: ' . $tier->getPrice().' LEI'; ?></p>
                </div>
            </div>
        <?php endforeach; ?>


</div>
