<?php

function get_var($key, $value = "")
{

    if (isset($_POST[$key])) {
        return $_POST[$key];
    }

    return $value;
}

function runThumbnail($image)
{
    $class = new Image;
    show($class->profileThumb($image));
}

function show($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function get_select($key, $value)
{
    if (isset($_POST[$key])) {
        if ($_POST[$key] == $value) {
            return "selected";
        }
    }

    return "";
}

function esc($var)
{
    return htmlspecialchars($var);
}

function random_string($length)
{
    $array = array(
        0, 1, 2, 3, 4, 5, 6, 7, 8, 9,
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v',
        'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S',
        'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
    );
    $text = "";
    for ($x = 0; $x < $length; $x++) {
        $random = rand(0, 61);
        $text .= $array[$random];
    }

    return $text;
}

function get_date($date)
{
    return date("jS M, Y", strtotime($date));
}

function views_path($view)
{
    if (file_exists("../private/views/" . $view . ".inc.php")) {
        return ("../private/views/" . $view . ".inc.php");
    } else {
        return ("../private/views/404.inc.php");
    }
}

function uploadImage($files)
{

    if (count($files) > 0) {
        $allowed[] = "image/jpeg";
        $allowed[] = "image/png";

        if ($files['image']['error'] == 0 && in_array($files['image']['type'], $allowed)) {
            $folder = "uploads/";
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }
            $destination = $folder . $files['image']['name'];
            move_uploaded_file($files['image']['tmp_name'], $destination);

            return $destination;
        }

        return false;
    }
}
