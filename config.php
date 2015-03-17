<?php
    /*
        The important thing to realize is that the config file should be included in every
        page of your project, or at least any page you want access to these settings.
        This allows you to confidently use these settings throughout a project because
        if something changes such as your database credentials, or a path to a specific resource,
        you'll only need to update it here.
    */

    $_SERVER["ROOT_PATH"] = "~andrew/codeGrader";
    $host = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $root = $_SERVER['HTTP_HOST'] . "/~andrew/CodeGrader";
    $relative = "/~andrew/CodeGrader";
     
    $config = array(
        "db" => array(
            "db1" => array(
                "dbname" => "codeGraderDB",
                "username" => "root",
                "password" => "password",
                "host" => "localhost"
            ),
            "db2" => array(
                "dbname" => "codegrader",
                "username" => "codegrader",
                "password" => "6NCPpzBuuN4Xy39m",
                "host" => "satnet.fgcu.edu"
            )
        ),
        "urls" => array(
            "baseUrl" => "http://codegrader.com"
        ),
        "paths" => array(
            "resources" => "/path/to/resources",
            "images" => array(
                "content" => $_SERVER["DOCUMENT_ROOT"] . "/images/content",
                "layout" => $_SERVER["DOCUMENT_ROOT"] . "/images/layout"
            )
        )
    );
     
    /*
        I will usually place the following in a bootstrap file or some type of environment
        setup file (code that is run at the start of every page request), but they work 
        just as well in your config file if it's in php (some alternatives to php are xml or ini files).
    */
     
    /*
        Creating constants for heavily used paths makes things a lot easier.
        ex. require_once(LIBRARY_PATH . "Paginator.php")
    */

    define('ROOT_DIR', dirname(__FILE__));

    defined("LIBRARY_PATH")
        or define("LIBRARY_PATH", realpath(__DIR__ . '/resources/library'));
         
    defined("TEMPLATES_PATH")
        or define("TEMPLATES_PATH", realpath(__DIR__ . '/resources/templates'));

    defined("ROOT_PATH")
        or define("ROOT_PATH", realpath(__DIR__ . '' ));


     
    /*
        Error reporting.
    */
    ini_set("error_reporting", "true");
    error_reporting(E_ALL|E_STRCT);
 
?>