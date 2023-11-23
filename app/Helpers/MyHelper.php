<?php

namespace App\Helpers;

class MyHelper
{
    public static function swall($type = "succ", $content = '', $reload = false)
    {
        if ($type == "succ") {
            $text = "Yeayyyyy!";
            $icon = "success";
        } else {
            $text = "Oooppssss!";
            $icon = "error";
        }



        if (!$reload) {
            $html = '<script>Swal.fire({
                title: "' . $text . '",
                text: "' . $content . '",
                icon: "' . $icon  . '"
            });</script>';
        } else {
            $html = '<script>Swal.fire({
                title: "' . $text . '",
                text: "' . $content . '",
                icon: "' . $icon  . '"
            }).then(function(){ 
                location.reload();
            });</script>';
        }



        return $html;
    }
}
