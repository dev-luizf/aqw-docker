function env(name: string, fallback = "") {
  const value = process.env[name];
  return value === undefined || value === "" ? fallback : value;
}

function integer(name: string, fallback: number) {
  const parsed = Number(env(name, String(fallback)));
  return Number.isFinite(parsed) ? parsed : fallback;
}

function menuPath(value: string) {
  return value && !value.includes("/") ? `gameMenu/${value}` : value;
}

export function gameVersion() {
  return {
    sFile: env("GAME_CLIENT_SWF", "spider.swf"),
    sTitle: env("GAME_CLIENT_TITLE", env("SITE_NAME", "Armagedom Worlds")),
    sBG: env("GAME_CLIENT_BG", "Back.swf"),
    sVersion: env("GAME_CLIENT_VERSION", "ARM001"),
  };
}

export function clientVariables() {
  return {
    sAssets: env("GAME_ASSETS", "AWAssets.swf"),
    sBook: env("GAME_BOOK", "news/spiderbook3.swf"),
    sFBC: env("GAME_FBC", "FBC-2011-03-08.swf"),
    sLoader: "",
    sMap: env("GAME_MAP", "news/Map-UI_r38.swf"),
    sMenu: menuPath(env("GAME_MENU")),
    gMenu: menuPath(env("GAME_MENU")),
    sNews: env("GAME_NEWS"),
    sNewUser: env("GAME_NEW_USER", "newuser/AW-Registration.swf"),
    sProfile: "",
    sWTSandbox: "false",
    iMaxBagSlots: integer("GAME_MAX_BAG_SLOTS", 500),
    iMaxBankSlots: integer("GAME_MAX_BANK_SLOTS", 900),
    iMaxHouseSlots: integer("GAME_MAX_HOUSE_SLOTS", 300),
    iMaxGuildMembers: integer("GAME_MAX_GUILD_MEMBERS", 800),
    iMaxFriends: integer("GAME_MAX_FRIENDS", 300),
    iMaxLoadoutSlots: integer("GAME_MAX_LOADOUT_SLOTS", 50),
  };
}

export const gameNetwork = {
  port: integer("GAME_PORT", 5588),
  publicIp: env("PUBLIC_GAME_IP", "127.0.0.1"),
  serverName: env("SERVER_NAME", "Armagedom"),
};
