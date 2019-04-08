<h2><?= $title; ?></h2>

<div>
    <ul class="list-group">
        <?php foreach($categories as $category): ?>
        <li class="list-group-item"><a href="<?php echo site_url('/categories/posts/').$category['fld_category_id'] ?>"><?php echo $category['fld_category_name']; ?></a></li>
        <?php endforeach; ?>
    </ul>

</div>
