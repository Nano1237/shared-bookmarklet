<?php

namespace sharedBookmarkled;

class AccessObject {

    public $authLevel = 0;
    public $userName = null;
    public $userEmail = null;

    public function __construct($authdata) {
        if ($authdata) {
            $this->setAuthData($authdata);
        }
    }

    /**
     * 
     * Sets the $authdata as property values to this object
     * @param array $authdata
     */
    private function setAuthData($authdata) {
        $this->authLevel = $authdata['access'];
        $this->userName = $authdata['user'];
        $this->userEmail = $authdata['email'];
    }

}

class AccessHandler {

    public function authUser($authData) {
        if (isset($authData['user'])) {
            return new AccessObject($this->getUserData($authData));
        }
        return new AccessObject(false);
    }

    /**
     * 
     * Here you can use any Datastorage you want, like MySql for example.
     * I am using a simple file with userdata.
     * Its neccesarry that you return an array with the following data if the user logs in successfully:
     *  return array(
     *      'user' => STRING,
     *      'access' => INTEGER,
     *      'email' => STRING
     *  );
     * And false if the user login doesnt work
     * @param Array $authData
     */
    private function getUserData($authData) {
        $datas = file_get_contents(ROOTPATH . 'private\\userdata.txt');
        foreach (explode("\n", $datas) as $userData) {
            $suu = explode(':', $userData);
            if ($suu[0] === $authData['user'] && $suu[1] === $authData['token']) {
                return array(
                    'user' => $suu[0],
                    'access' => $suu[2],
                    'email' => $suu[3]
                );
            }
        }
        return false;
    }

}
