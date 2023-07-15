<?php
require_once __DIR__ . "/it.php";
require_once __DIR__ . "/en.php";


function get_string($lang, $string, ...$vars): string
{
    global $$lang;
    if (is_array($$lang[$string]))
        return vsprintf(implode("\n", $$lang[$string]), $vars);
    else
        return vsprintf($$lang[$string], $vars);
}

function get_button($lang, $string)
{
    global $$lang;
    return $$lang["btn"][$string];
}

function getString($lang, $string, ...$vars)
{
    global $$lang;
    return $$lang[$string];
}

function getButton($lang, $string)
{
    global $$lang;
    return $$lang["btn"][$string];
}