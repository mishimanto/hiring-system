<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'description',
        'order'
    ];

    /**
     * Get setting value by key
     */
    public static function get($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Set setting value
     */
    public static function set($key, $value): void
    {
        self::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }

    /**
     * Get all settings grouped
     */
    public static function getAllGrouped()
    {
        return self::orderBy('order')->get()->groupBy('group');
    }

    /**
     * Get general settings
     */
    public static function getGeneralSettings()
    {
        return self::where('group', 'general')->orderBy('order')->get();
    }

    /**
     * Get contact settings
     */
    public static function getContactSettings()
    {
        return self::where('group', 'contact')->orderBy('order')->get();
    }

    /**
     * Get legal settings
     */
    public static function getLegalSettings()
    {
        return self::where('group', 'legal')->orderBy('order')->get();
    }

    /**
     * Get social settings
     */
    public static function getSocialSettings()
    {
        return self::where('group', 'social')->orderBy('order')->get();
    }

    /**
     * Get SEO settings
     */
    public static function getSeoSettings()
    {
        return self::where('group', 'seo')->orderBy('order')->get();
    }
}