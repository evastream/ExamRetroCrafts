<?php 
/**
 * Fieldthemes
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the Fieldthemes.com license that is
 * available through the world-wide-web at this URL:
 * http://www.fieldthemes.com/license-agreement.html
 * 
 * DISCLAIMER
 * 
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 * 
 * @category   Fieldthemes
 * @package    Field_Baseconnector
 * @copyright  Copyright (c) 2014 Fieldthemes (http://www.fieldthemes.com/)
 * @license    http://www.fieldthemes.com/LICENSE-1.0.html
 */
namespace Field\BaseWidget\Controller\Adminhtml\Basewidget;
use Magento\Framework\App\Filesystem\DirectoryList;

class Connector extends \Field\BaseWidget\Controller\Adminhtml\Basewidget {

    protected function getDirPath( $dir_name = "") {
       return $this->_filesystem->getDirectoryWrite($dir_name)->getAbsolutePath();
    }
    /**
     * index action
     */ 
    public function execute() {
        //$elfinder_path  = $this->getDirPath(DirectoryList::APP).'code'.DIRECTORY_SEPARATOR.'Field'.DIRECTORY_SEPARATOR.'BaseWidget'.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.'adminhtml'.DIRECTORY_SEPARATOR.'web'.DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'elfinder'.DIRECTORY_SEPARATOR.'php'.DIRECTORY_SEPARATOR;
        
        //include_once $elfinder_path.'elFinderConnector.class.php';
        //include_once $elfinder_path.'elFinder.class.php';
        //include_once $elfinder_path.'elFinderVolumeDriver.class.php';
        //include_once $elfinder_path.'elFinderVolumeLocalFileSystem.class.php';


        $root_media_folder = $this->_viewHelper->getConfig('general/root_media');
        $path = $this->_mediaDirectory->getAbsolutePath();
        $url = $this->getBaseMediaUrl();

        if($root_media_folder) {
            $path2 = $this->_mediaDirectory->getAbsolutePath().'/'.$root_media_folder."/";
            $url2 = $this->getBaseMediaUrl().$root_media_folder."/";
            if(file_exists($path2)) {
               $path = $path2;
               $url = $url2;
            }
        }

        $opts = array(
            // 'debug' => true,
            'roots' => array(
                array(
                    'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
                    'path'          => $path,         // path to files (REQUIRED)
                    'URL'           => $url, // URL to files (REQUIRED)
                    'accessControl' => 'access'             // disable and hide dot starting files (OPTIONAL)
                )
            )
        );

        // run elFinder
        $connector = new \Field\BaseWidget\Classes\Elfinder\ElFinderConnector(new \Field\BaseWidget\Classes\ElFinder($opts));
        $connector->run();

        exit();
    }

    public function getBaseMediaUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }

    /**
     * Check the permission to run it
     *
     * @return boolean
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Field_BaseWidget::manage_media');
    }
    
}
?>