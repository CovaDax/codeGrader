<?php 
    require_once('config.php');

    function __AUTOLOAD($class_name){
    	include_once(ROOT_PATH . "/models/" . $class_name . ".php");
    }



    session_start();
    if(!isset($_SESSION["username"])){
        header("Location:view/templates/forms/login_form.php");
    }

    // echo ROOT_DIR;
    // echo $_SERVER['HTTP_HOST'];
    // echo dirname($_SERVER['PHP_SELF']);

            // $db = new Database($config['db']);
            // $results = $db->query("SELECT * FROM course");
            // if($results->num_rows > 0){
            //     while($row = $results->fetch_assoc()){
            //         $course = new Course($row['crn'], $row['title'], $row['catalog'], $row['section']);
            //         if(!file_exists("models/data/courses")){
            //             echo "<PRE>";
            //             mkdir("models/data/courses", 0744) or print_r(error_get_last());
            //         }
            //         $s = serialize($course) or die("Can't Serialize");
            //         $fp = fopen("models/data/courses/".$row['crn'], "w");
            //         fwrite($fp, $s) or die("Can't Write");
            //         fclose($fp);

            //         $f = implode("", @file("models/data/courses/".$row['crn']));
            //         $a = unserialize($f) or die("Can't deserialize");

            //         //echo $a->crn;
            //     }
            // }

    header("Location:view/courses.php");
?>
