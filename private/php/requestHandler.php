<?php

namespace sharedBookmarkled;

class RequestHandler {

    /**
     * 
     * @todo Escape the requests to prevent XSS
     * @param String|Boolean $paramName The name of the post-parameter
     * @return variable
     */
    public function post($paramName = false, $defaultReturn = false) {
        if ($paramName) {
            if (isset($_POST[$paramName])) {
                return $_POST[$paramName];
            }
            return $defaultReturn;
        }
        return $_POST;
    }

}
