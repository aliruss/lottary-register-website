<?php

use App\KeyValue;

/**
 * key value for application
 *
 * @param [type] $key
 * @param boolean $val
 * @return void
 */
function kv($key, $val = false)
{
    if ($val === false) {
        return KeyValue::get($key);
    }

    KeyValue::set($key, $val);
}
