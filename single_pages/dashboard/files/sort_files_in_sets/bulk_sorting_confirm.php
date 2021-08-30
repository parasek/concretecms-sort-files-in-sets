<?php defined('C5_EXECUTE') or die('Access Denied.'); ?>

<div id="sort-files-in-sets">

    <div class="ccm-dashboard-header-buttons">
        <a href="<?php echo $app->make('url/manager')->resolve(['dashboard/files/sort_files_in_sets/bulk_sorting']); ?>"
           class="btn btn-secondary"><i class="fa fa-angle-double-left"></i> <?php echo t('Go back'); ?></a>
    </div>

    <p><?php echo t('Files in Sets below will be sorted alphabetically by:'); ?></p>

    <form method="post" class="ccm-dashboard-content-form" action="<?php echo $view->action('bulk_sorting_submit'); ?>">

        <?php echo $this->controller->token->output('submit'); ?>

        <fieldset>
            <div class="form-group">
                <?php echo $form->select('sortBy', ['filename'=>t('Filename'), 'title'=>t('Title')], ['placeholder'=>t('Filter by name')]); ?>
            </div>
        </fieldset>

        <fieldset>
            <p class="lead"><?php echo t('Selected File Sets'); ?></p>
            <ul>
            <?php foreach ($this->post('fileSets') as $fileSetID): ?>
                <?php
                $fileSet = FileSet::getByID($fileSetID);
                ?>
                <?php if (is_object($fileSet)): ?>
                    <li>
                        <?php echo $form->hidden('fileSets[]', $fileSetID); ?>
                        <span><?php echo $fileSet->getFileSetName(); ?></span>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
            </ul>
        </fieldset>

        <div class="ccm-dashboard-form-actions-wrapper">
            <div class="ccm-dashboard-form-actions">
                <a href="<?php echo $view->action('bulk_sorting'); ?>" class="btn btn-secondary float-start">Anuluj</a>
                <button class="float-end btn btn-primary" type="submit" ><?php echo t('Confirm'); ?></button>
            </div>
        </div>

    </form>

</div>