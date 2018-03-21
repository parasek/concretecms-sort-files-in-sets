<?php defined('C5_EXECUTE') or die('Access Denied.'); ?>


<div id="sort-files-in-sets">

    <div class="ccm-dashboard-header-buttons">
        <a href="<?php echo $app->make('url/manager')->resolve(['dashboard/files/sort_files_in_sets']); ?>"
           class="btn btn-default"><i class="fa fa-angle-double-left"></i> <?php echo t('Go back'); ?></a>
    </div>

    <form class="max-width-desktop">
        <fieldset>
            <div class="form-group">
                <?php echo $form->text('filterByName', '', ['placeholder'=>t('Filter by name')]); ?>
            </div>
            <div class="checkbox">
                <label>
                    <?php echo $form->checkbox('toggleAllVisible', 1, false); ?> <?php echo t('Select/deselect all visible'); ?>
                </label>
            </div>
        </fieldset>
    </form>


    <form method="post" class="ccm-dashboard-content-form" action="<?php echo $view->action('bulk_sorting_confirm'); ?>">

        <?php echo $this->controller->token->output('submit'); ?>

        <fieldset>
            <p class="lead"><?php echo t('File Sets'); ?></p>
            <?php foreach ($sets as $set): ?>
                <div class="checkbox js-file-set" data-file-set-name="<?php echo $set->fsName; ?>">
                    <label>
                        <?php echo $form->checkbox('fileSets[]', $set->fsID, false, ['class'=>'js-file-set-input']); ?> <?php echo $set->fsName; ?>
                    </label>
                </div>
            <?php endforeach; ?>
        </fieldset>

        <div class="ccm-dashboard-form-actions-wrapper">
            <div class="ccm-dashboard-form-actions">
                <button class="pull-right btn btn-primary" type="submit" ><?php echo t('Sort Files in selected Sets'); ?></button>
            </div>
        </div>

    </form>

</div>


