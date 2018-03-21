<?php namespace Concrete\Package\SortFilesInSets\Controller\SinglePage\Dashboard\Files;

use Concrete\Core\Asset\AssetList;
use Concrete\Core\File\Set\Set as FileSet;
use Concrete\Core\Page\Controller\DashboardPageController;

defined('C5_EXECUTE') or die('Access Denied.');

class SortFilesInSets extends DashboardPageController
{

    public function on_start() {

        parent::on_start();

        $al = AssetList::getInstance();

        // Load css
        $al->register('css', 'sort-files-in-sets/css', 'css_files/sort-files-in-sets.css', [], 'sort_files_in_sets');
        $this->requireAsset('css', 'sort-files-in-sets/css');

        // Load js files
        $al->register('javascript', 'sort-files-in-sets/mark-js', 'vendor/jquery.mark.min.js', [], 'sort_files_in_sets');
        $this->requireAsset('javascript', 'sort-files-in-sets/mark-js');

        $al->register('javascript', 'sort-files-in-sets/js', 'js_files/sort-files-in-sets.js', [], 'sort_files_in_sets');
        $this->requireAsset('javascript', 'sort-files-in-sets/js');

        // Make $app available in view
        $this->set('app', $this->app);

    }

    public function view() {

        $sets = $this->getFileSets();
        $this->set('sets', $sets);

    }

    public function bulk_sorting() {

        $sets = $this->getFileSets();
        $this->set('sets', $sets);

        $this->set('pageTitle', t('Bulk sorting'));

        $this->render('/dashboard/files/sort_files_in_sets/bulk_sorting');

    }

    public function bulk_sorting_confirm() {

        if (!$this->post() OR !is_array($this->post('fileSets')) OR !count($this->post('fileSets'))) {
            $this->redirect('/dashboard/files/sort_files_in_sets/bulk_sorting');
        }

        if (!$this->token->validate('submit')) {
            $this->redirect('/dashboard/files/sort_files_in_sets');
        }

        $this->set('pageTitle', t('Are you sure?'));

        $this->render('/dashboard/files/sort_files_in_sets/bulk_sorting_confirm');

    }

    public function bulk_sorting_submit() {

       if (!$this->post() OR !is_array($this->post('fileSets')) OR !count($this->post('fileSets'))) {
           $this->redirect('/dashboard/files/sort_files_in_sets');
       }

       if (!$this->token->validate('submit')) {
           $this->redirect('/dashboard/files/sort_files_in_sets');
       }

       foreach ($this->post('fileSets') as $fileSetID) {

           $fileSet = FileSet::getByID($fileSetID);

           if (is_object($fileSet)) {

               $files = $fileSet->getFiles();
               $tempFiles = [];
               foreach ($files as $file) {
                   if ($this->post('sortBy')=='filename') {
                       $tempFileValue = $file->getFileName();
                   } else {
                       $tempFileValue = $file->getTitle();
                   }
                   $tempFiles[$file->getFileID()] = $tempFileValue;
               }

               asort($tempFiles, SORT_NATURAL);

               $positions = [];
               foreach ($tempFiles as $k => $v) {
                   $positions[] = $k;
               }

               $fileSet->updateFileSetDisplayOrder($positions);

           }

       }

       $this->redirect('/dashboard/files/sort_files_in_sets/bulk_sorting_success');

    }


    public function bulk_sorting_success() {

        $this->set('success', t('Files in selected Sets has been sorted alphabetically.'));

        $this->view();

    }

    public function fileset($fileSetID) {

        $this->set('pageTitle', t('Edit File Set'));

        $this->render('/dashboard/files/sort_files_in_sets/fileset');

    }

    private function getFileSets() {

        $sets = FileSet::getMySets();

        return $sets;

    }

}
