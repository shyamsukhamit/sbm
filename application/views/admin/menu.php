<div class="col-md-2 col-lg-2 col-sm-2 col-xs-12">
    
    <br/>
    <ul class="nav nav-pills nav-stacked">
<?php foreach($menu as $item): ?>
        <li<?= $item["is_active"] ? " class=\"active\"" : ""; ?>><a href="<?= $item["link"] ?>"><?= $item["title"]; ?></a></li>
<?php endforeach; ?>
    </ul>
</div>