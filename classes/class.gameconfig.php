<?php
/**
 * Environment-backed game/client configuration.
 *
 * The database contains a compatibility copy for the legacy emulator, but all
 * configurable values exposed by PHP originate here.
 */
class GameConfig
{
    public static function env($name, $default = '')
    {
        $value = getenv($name);
        return $value === false ? $default : $value;
    }

    public static function clientSettings()
    {
        $settings = array(
            'gMenu' => self::env('GAME_MENU', ''),
            'sAssets' => self::env('GAME_ASSETS', 'AWAssets.swf'),
            'sBG' => self::env('GAME_CLIENT_BG', 'Back.swf'),
            'sBook' => self::env('GAME_BOOK', 'news/spiderbook3.swf'),
            'sFBC' => self::env('GAME_FBC', 'FBC-2011-03-08.swf'),
            'sFile' => self::env('GAME_CLIENT_SWF', 'spider.swf'),
            'sLoader' => '',
            'sMap' => self::env('GAME_MAP', 'news/Map-UI_r38.swf'),
            'sNews' => self::env('GAME_NEWS', ''),
            'sNewUser' => self::env('GAME_NEW_USER', 'newuser/AQW-Landing-r6.swf'),
            'sProfile' => '',
            'sTitle' => self::env('GAME_CLIENT_TITLE', self::env('SITE_NAME', 'Armagedom Worlds')),
            'sVersion' => self::env('GAME_CLIENT_VERSION', 'ARM001'),
            'sWTSandbox' => 'false',
            'iMaxBagSlots' => self::env('GAME_MAX_BAG_SLOTS', '500'),
            'iMaxBankSlots' => self::env('GAME_MAX_BANK_SLOTS', '900'),
            'iMaxHouseSlots' => self::env('GAME_MAX_HOUSE_SLOTS', '300'),
            'iMaxGuildMembers' => self::env('GAME_MAX_GUILD_MEMBERS', '800'),
            'iMaxFriends' => self::env('GAME_MAX_FRIENDS', '300'),
            'iMaxLoadoutSlots' => self::env('GAME_MAX_LOADOUT_SLOTS', '50'),
        );

        if ($settings['gMenu'] !== '' && strpos($settings['gMenu'], '/') === false) {
            $settings['gMenu'] = 'gameMenu/' . $settings['gMenu'];
        }

        return $settings;
    }

    public static function applyClientSettings($target)
    {
        foreach (self::clientSettings() as $name => $value) {
            if (is_array($target)) {
                $target[$name] = $value;
            } else {
                $target->{$name} = $value;
            }
        }
        return $target;
    }
}
