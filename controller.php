<?php namespace Concrete\Package\SortFilesInSets;

use Concrete\Core\Package\Package;
use Concrete\Core\Page\Single as SinglePage;

defined('C5_EXECUTE') or die('Access Denied.');

class Controller extends Package
{
    protected $pkgHandle = 'sort_files_in_sets';
    protected $appVersionRequired = '9.0.0';
    protected $pkgVersion = '2.0.0';

    public function getPackageName() {
        return t('Sort Files in Sets');
    }

    public function getPackageDescription() {
        return t('Easy way to sort files in your sets.');
    }

    public function on_start() {

    }

    public function install() {

        $pkg = parent::install();

        // Install single pages
        $page = SinglePage::add('/dashboard/files/sort_files_in_sets', $pkg);
        $page->updateCollectionName(t('Sort Files in Sets'));

    }

}