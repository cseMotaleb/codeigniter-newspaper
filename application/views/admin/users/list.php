<div class="row">
    <div class="col-lg-6">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa-fw fa fa-list"></i> Users
        </h1>
    </div>
    <div class="col-lg-6 pull-right">
        <button class="btn btn-danger changeURL pull-right" data-url="#users/manage"><i class="fa fa-plus-circle"></i>
            Add User
        </button>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h4><i class="fa fa-list"></i> User List</h4>
    </div>
    <?php $total_rows = count($rows); ?>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>E-mail</th>
            <th>User Type</th>
            <th>Password</th>
            <th>Status</th>
            <th class="text-center" colspan="2">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($total_rows > 0) {
            foreach ($rows as $row) {
                if ($row['id'] != 1) {
                    $label = ($row['enabled'] == 1) ? 'label-success' : 'label-danger';
                    $status = ($row['enabled'] == 1) ? 'Enabled' : 'Disabled';
                    $image = (file_exists("./uploads/agents/{$row['image']}")) ? base_url() . "uploads/agents/{$row['image']}" : "";
                    ?>
                    <tr id="hiderow<?= $row['id']; ?>">
                        <td>
                            <?php if ($image) { ?><img style="width: 65px; height: 65px;" alt=""
                                                       src="<?= $image; ?>" /><?php } ?>
                        </td>
                        <td><?= "{$row['first_name']} {$row['last_name']}"; ?></td>
                        <td><?= $row['email']; ?></td>
                        <td><?= $row['user_type']; ?></td>
                        <td><?= $row['password']; ?></td>
                        <td><span class="label <?= $label; ?>"><?= $status; ?></span></td>
                        <td class="text-center">
                            <a href="#users/manage/edit/<?= $row['id']; ?>" class="btn btn-primary btn-xs"
                               title="Edit"><i class="fa fa-pencil"></i></a>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-danger btnDel btn-xs"
                               data-url="<?= site_url("admin/users/manage/delete/"); ?>" data-toggle="modal"
                               data-target="#myModal" id="<?= $row['id'] ?>" title="Delete"><i
                                        class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                <?php }
            }
        } else echo "<tr><td colspan=\"7\">No resault found.</td></tr>" ?>
        </tbody>
    </table>

    <?php if ($total_rows > 0) { ?>
        <div class="panel-footer">
            <div class="text-right">
                <?= $pagination; ?>
            </div>
        </div>
    <?php } ?>
</div>


<?php $this->load->view("admin/common-delete-modal");


?>

<script src="<?= base_url(); ?>assets/js/holder.min.js"></script>
<script src="<?= base_url(); ?>assets/admin/js/custom.js"></script>