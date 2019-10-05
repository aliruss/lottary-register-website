<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Stores application configurations as key-value pairs
 * where `key` is a unique string and `value` is encoded into JSON.
 */
class KeyValue extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = ['key', 'value'];
    protected $keyType = 'string';
    protected $primaryKey = 'key';

    protected static $store = null;

    /**
     * Returns value of given key.
     *
     * @param string $key
     * @return mixed
     */
    public static function get($key)
    {
        if (self::$store == null) {
            self::loadStore();
        }

        if (isset(self::$store[$key])) {
            return self::$store[$key];
        }

        return '';
    }

    /**
     * Sets value for given key.
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function set($key, $value)
    {
        $kv = self::where('key', $key)->first();
        if (!$kv) {
            self::create(['key' => $key, 'value' => json_encode($value)]);
            return;
        }

        $kv->value = json_encode($value);
        $kv->save();

        self::loadStore();
    }

    protected static function loadStore()
    {
        self::$store = [];
        $items = KeyValue::all();
        foreach ($items as $item) {
            self::$store[$item->key] = json_decode($item->value, true);
        }
    }
}
