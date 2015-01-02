<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace sharedBookmarkled;

class JavascriptHandler {

    private $domainName = '';

    public function loadFiles($dm) {
        $this->domainName = $dm;
        $return = file_get_contents(ROOTPATH . 'private/sharedBookmarklet.js');
        foreach ($this->getJavascriptFiles() as $file) {
            $return .= file_get_contents($file);
        }
        echo '<script>';
        echo $return;
        echo '</script>';
    }
    /**
     * 
     * This method checks if the file iss accessable by the user
     * @todo clean this method and put it in another class maybe
     * @param type $fileData
     * @return boolean
     */
    private function checkFileAccess($fileData) {
        if (count($fileData) === 3) {
            if ($fileData[2] === 'start.js' && $this->domainName === $fileData[0]) {
                return 'start';
            }
        } elseif (count($fileData) < 4) {
            return false;
        }
        if ($this->domainName !== $fileData[1]) {
            return false;
        }
        if ($this->authObject->authLevel < $fileData[2]) {
            return false;
        }
        return true;
    }

    private function getJavascriptFiles($dir = ROOTPATH . 'private/js', $return = array()) {
        if ($handle = opendir($dir)) {
            while (false !== ($file = readdir($handle))) {
                if ($file !== '.' && $file !== '..') {
                    if (strpos($file, '.') !== false) {
                        $ttt = $this->checkFileAccess(explode('_', $file));
                        if ($ttt === 'start') {
                            $return[9999] = $dir . '/' . $file;
                        } elseif ($ttt) {
                            array_push($return, $dir . '/' . $file);
                        }
                    } else {
                        $return = $this->getJavascriptFiles($dir . '/' . $file, $return);
                    }
                }
            }
            closedir($handle);
        }
        return $return;
    }

}
