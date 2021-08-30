<?php defined('C5_EXECUTE') or die('Access Denied.'); ?>

<div id="sort-files-in-sets">

    <div class="ccm-dashboard-header-buttons">
        <a href="<?php echo $app->make('url/manager')->resolve(['dashboard/files/sort_files_in_sets/bulk_sorting']); ?>"
           class="btn btn-primary"><?php echo t('Bulk sorting'); ?></a>
    </div>

    <p class="lead"><?php echo t('File Sets'); ?></p>

    <ul class="file-set-list">
        <?php foreach ($sets as $set): ?>
            <li>
                <a href="<?php echo $app->make('url/manager')->resolve(['dashboard/files/sort_files_in_sets/fileset/'.$set->fsID]); ?>">
                    <?php echo $set->fsName; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

</div>