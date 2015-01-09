<?php

namespace sharedBookmarkled;

class Core {

    private $AccessHandler;
    private $RequestHandler;
    private $JavascriptHandler;
    private $authObject;

    /**
     *
     * All dependencie classes must be listet here. 
     * All classes will be constructed with the sharedBookmarkled namespace.
     * If you want to add a private class as property, then you have to add a private property with the class name manualy to this class.
     * @var Array
     */
    private $dependencies = array(
        'AccessHandler' => 'accessHandler.php',
        'RequestHandler' => 'requestHandler.php',
        'JavascriptHandler' => 'javascriptHandler.php'
    );

    public function __construct() {
        $this->loadDependencies();
        $this->start();
    }

    /**
     * Here we load the dependencie classes and construct them as property in our Core Object
     */
    private function loadDependencies() {
        foreach ($this->dependencies as $class => $file) {
            require_once($file);
            $className = '\\sharedBookmarkled\\' . $class;
            $this->{$class} = new $className();
        }
    }

    /**
     * Here starts everything
     */
    public function start() {
        //Adding header for Ajax calls to this site from somewhere else
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');
        $this->authObject = $this->AccessHandler->authUser($this->RequestHandler->post('auth'));
        $this->JavascriptHandler->loadFiles($this->RequestHandler->post('domain'));
    }

}
