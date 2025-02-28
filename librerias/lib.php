<?php 
function limpiar($valor)
{
    return htmlspecialchars(trim(strip_tags($valor)));
}
?>