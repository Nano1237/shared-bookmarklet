<?php

namespace sharedBookmarkled;

class AccessObject {

    public $authLevel = 2;
    public $userName = null;
    public $userEmail = null;

    public function __construct($authdata) {
        if ($authdata) {
            $this->setAuthData($authdata);
        }
    }

    private function setAuthData($authdata) {
        
    }

}

class AccessHandler {

    public function authUser($authData) {
        if (isset($authData['user'])) {
            return new AccessObject($authData);
        }
        return new AccessObject(false);
    }

}
