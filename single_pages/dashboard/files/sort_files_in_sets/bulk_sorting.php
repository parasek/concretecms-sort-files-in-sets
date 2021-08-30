<?php defined('C5_EXECUTE') or die('Access Denied.'); ?>


<div id="sort-files-in-sets">

    <div class="ccm-dashboard-header-buttons">
        <a href="<?php echo $app->make('url/manager')->resolve(['dashboard/files/sort_files_in_sets']); ?>"
           class="btn btn-secondary"><i class="fa fa-angle-double-left"></i> <?php echo t('Go back'); ?></a>
    </div>

    <form>
        <fieldset>
            <div class="form-group">
                <?php echo $form->text('filterByName', '', ['placeholder'=>t('Filter by name')]); ?>
            </div>
            <div class="form-check">
                <?php echo $form->checkbox('toggleAllVisible', 1, false); ?>
                <label for="toggleAllVisible" class="form-check-label">
                    <?php echo t('Select/deselect all visible'); ?>
                </label>
            </div>
        </fieldset>
    </form>


    <form method="post" class="ccm-dashboard-content-form" action="<?php echo $view->action('bulk_sorting_confirm'); ?>">

        <?php echo $this->controller->token->output('submit'); ?>

        <fieldset class="mt-4">
            <p class="lead"><?php echo t('File Sets'); ?></p>
            <?php $i = 0; ?>
            <?php foreach ($sets as $set): ?>
                <?php $i++; ?>
                <div class="form-check js-file-set" data-file-set-name="<?php echo $set->fsName; ?>">
                    <?php echo $form->checkbox('fileSets[]', $set->fsID, false, ['class'=>'js-file-set-input form-check-input', 'id'=>'file_set_'.$i]); ?>
                    <label for="file_set_<?php echo $i; ?>" class="form-check-label">
                        <?php echo $set->fsName; ?>
                    </label>
                </div>
            <?php endforeach; ?>
        </fieldset>

        <div class="ccm-dashboard-form-actions-wrapper">
            <div class="ccm-dashboard-form-actions">
                <button class="float-end btn btn-primary" type="submit" ><?php echo t('Sort Files in selected Sets'); ?></button>
            </div>
        </div>

    </form>

</div>


