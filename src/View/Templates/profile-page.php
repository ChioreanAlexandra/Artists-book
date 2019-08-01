<?php $data = isset($data) && is_array($data) ? $data : []; ?>
<?php if (!isset($data['user'])): return; endif;?>
<?php $user=$data['user']; ?>
<div class="content">
    <h1>Profile page</h1>

    <div>
        <table class="table table-sm">
            <tbody>
            <tr class="table-success">
                <th scope="row">1</th>
                <td>Name</td>
                <td><?php echo $user->getName() ?></td>
            </tr>
            <tr class="table-success">
                <th scope="row">2</th>
                <td>Email</td>
                <td><?php echo $user->getEmail()?></td>
            </tr>

            </tbody>
        </table>
    </div>

</div>

</div>

