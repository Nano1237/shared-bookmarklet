<?php

namespace sharedBookmarkled;

class JavascriptHandler {

    /**
     * The current Domainname saved as property
     * @var String
     */
    private $domainName = '';

    /**
     * Loads the JavaScript files for the Current Domain
     * @param Stirng $domainName The Current Domainname
     */
    public function loadFiles($domainName) {
        $this->domainName = $domainName;
        $return = file_get_contents(ROOTPATH . 'private/sharedBookmarklet.js');
        $return .= $this->loadGlobals();
        foreach ($this->getJavascriptFiles() as $fileName) {
            $return .= file_get_contents($fileName);
        }
        echo $return;
    }

    /**
     * Loads all global JavaScript files
     * @todo build a function that only loads needet files!
     * @return Stirng
     */
    private function loadGlobals() {
        $return = '';
        foreach ($this->getJavascriptFiles(ROOTPATH . 'private/globals', array(), true) as $fileName) {
            if (preg_match('/\.js$/', $fileName)) {
                $return .= file_get_contents($fileName);
            }
        }
        return $return;
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

    /**
     * 
     * @todo this method is also VERRY dirty, it needs to be cleaned an separeted
     * @param type $dir the directory of the javascript files
     * @param type $return the array that is finaly returned (needet for recursive call)
     * @param type $access needs to be in another method, its just here to allow the access method to check if the file is accesible if the value is false. if true the return of the access method is ignored.
     * @return array
     */
    private function getJavascriptFiles($dir = ROOTPATH . 'private/js', $return = array(), $access = false) {
        if ($handle = opendir($dir)) {
            while (false !== ($file = readdir($handle))) {
                if ($file !== '.' && $file !== '..') {
                    if (strpos($file, '.') !== false) {
                        $ttt = $this->checkFileAccess(explode('_', $file));
                        if ($ttt === 'start') {
                            $return[9999] = $dir . '/' . $file;
                        } elseif ($ttt || $access) {
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
