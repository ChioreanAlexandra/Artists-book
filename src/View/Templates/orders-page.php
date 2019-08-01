<div class="container">
    <h2>Order products Gallery</h2>

    <div class="row">
        <?php /** @var $tier \MyApp\Model\DomainObjects\Tier */ ?>
        <?php foreach ($tierList as $tier): ?>
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="<?php echo $tier->getPathWithWatermark() ?>" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text"><?php echo $tier->getSize() . '<br>' . $tier->getPrice(); ?></p>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>
