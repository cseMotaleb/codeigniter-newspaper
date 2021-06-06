<?php
$i = 0;
if (isset($rows) && is_countable($rows) && count($rows) > 0) {
    foreach ($rows as $row) {
        $media_image = (@file_exists("{$row['url']}")) ? base_url() . "{$row['url']}" : base_url() . "uploads/avatar.png";
        $type = ucwords(str_replace('_', ' ', $row['type']));

        $page = get_rows(array("table" => "page_types", "limit" => 1), array("id" => $row['page_id']));
        $page_text = (isset($page['type'])) ? $page['type'] : "";
        ?>
        <tr id="hiderow<?= $row['id']; ?>">
            <td>
                <img class="img-thumbnail" style="height: 60px; width: 80px;" alt="<?= $row['title']; ?>"
                     src="<?= $media_image; ?>"/>
            </td>
            <td><?= $row['title']; ?></td>
            <td>
                <textarea id="imglink<?= $i; ?>" class="form-control autosize_textarea" cols="25"
                          rows="3"><?= $media_image; ?></textarea>
            </td>
            <td class="text-center">
                <div class="btn-group">
                    <a href="#media/manage/edit/<?= $row['id']; ?>" class="btn btn-default btn-xs"
                       title="Edit"><i class="fa fa-pencil"></i></a>
                    <?php /* <a class="btn btn-default btnDel btn-xs" data-url="<?= site_url("admin/media/manage/delete/"); ?>" data-toggle="modal" data-target="#myModal" id="<?= $row['id']; ?>" title="Delete" ><i class="fa fa-trash-o"></i></a>*/ ?>
                </div>
            </td>
        </tr>
        <?php
        $i++;
    }
} else echo '<tr><td colspan="4">No result found.</td></tr>' ?>