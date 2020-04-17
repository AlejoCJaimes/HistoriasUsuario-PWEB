<?php

function encriptar($clave) {

  $clave = encriptando($clave);
  return $clave;
}
function encriptando($data = "", $width=192, $rounds = 3) {
    return substr(
        implode(
            array_map(
                function ($h) {
                    return str_pad(bin2hex(strrev($h)), 16, "0");
                },
                str_split(hash("tiger192,$rounds", $data, true), 8)
            )
        ),
        0, 32-(192-$width)/4
    );
}


?>
