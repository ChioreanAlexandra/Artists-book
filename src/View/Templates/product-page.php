<?php use MyApp\Model\Helper\Form\ImageFields; ?>
<?php $data = isset($data) && is_array($data) ? $data : []; ?>
<?php if (!isset($data['product'])): return; endif; ?>
<?php if (!isset($data['tag'])): return; endif; ?>

<?php /** @var $product \MyApp\Model\DomainObjects\Product */ ?>
<?php $product = $data['product']; ?>
<?php $tags = $data['tag']; ?>
<?php $tiers = $product->getTiers(); ?>
<?php if (!isset($tiers)): return; endif; ?>
<div style="color: black; size: 12px; font-weight: bold">
    <table class="table table-sm">
        <tbody>
        <tr class="table-success">
            <th scope="row">1</th>
            <td>Title</td>
            <td><?php echo $product->getTitle() ?></td>
        </tr>
        <tr class="table-success">
            <th scope="row">2</th>
            <td>Description</td>
            <td><?php echo $product->getTitle()?></td>
        </tr>
        <tr class="table-success">
            <th scope="row">3</th>
            <td>Capture data</td>
            <td><?php echo $product->getCaptureDate()->format('Y-m-d H:i:s')?></td>
        </tr>
        <tr class="table-success">
            <th scope="row">4</th>
            <td>Camera specifications</td>
            <td><?php echo $product->getCameraSpecs()?></td>
        </tr>
        <tr class="table-success">
            <th scope="row">5</th>
            <td>Tags</td>
            <td><?php
                foreach ($tags as $item):
                    echo $item->getTagName().';';
                endforeach; ?>
            </td>
        </tr>
        <?php $i=6; foreach ($tiers as $tier): ?>
            <tr class="table-success">
                <th scope="row"><?php echo $i++;?></th>
                <td><?php echo  'Price '.$tier->getSize().' '.$tier->getPrice().' LEI'  ?></td>
                <td><a class="btn btn-primary" href="/<?php echo ImageFields::IMAGES_DIRECTORY . $tier->getPathWithWatermark(); ?>"
                       role="button" target="_blank"><?php echo 'Preview ' . $tier->getSize() . " tier" ?></a>
                </td>
            </tr>

        <?php endforeach; ?>


        </tbody>
    </table>
</div>
<form action="/product/buyProduct/<?php echo $product->getId(); ?>" method="post">
    <select name="tierId" class="browser-default custom-select">
        <option value="<?php echo $tiers['large']->getId(); ?>">Large tier</option>
        <option value="<?php echo $tiers['medium']->getId(); ?>">Medium tier</option>
        <option value="<?php echo $tiers['small']->getId(); ?>">Small tier</option>
    </select>
    <input class="btn btn-primary" type="submit" value="Buy">

</form>

</div>

<div style="clear: both;"></div>
</div>

</div>

