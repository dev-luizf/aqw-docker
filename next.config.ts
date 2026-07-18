import type { NextConfig } from "next";

const nextConfig: NextConfig = {
  output: "standalone",
  poweredByHeader: false,
  experimental: {
    serverActions: {
      bodySizeLimit: "2mb",
    },
  },
  async headers() {
    return [
      {
        source: "/gamefiles/:path*",
        headers: [{ key: "Cache-Control", value: "no-store" }],
      },
    ];
  },
  async rewrites() {
    return {
      beforeFiles: [
        { source: "/game/api/login/now", destination: "/api/login/now" },
        {
          source: "/gamefiles/newuser/registration.swf",
          destination: "/gamefiles/newuser/AW-Registration.swf",
        },
        {
          source: "/gamefiles/loaders/api/login/now",
          destination: "/api/login/now",
        },
        { source: "/game/api/data/:path*", destination: "/api/data/:path*" },
        { source: "/standalone/api/data/gameversion", destination: "/api/data/gameversion" },
        {
          source: "/game/standalone/api/data/gameversion",
          destination: "/api/data/gameversion",
        },
        {
          source: "/gamefiles/standalone/api/data/gameversion",
          destination: "/api/data/gameversion",
        },
        {
          source: "/gamefiles/api/data/gameversion",
          destination: "/api/data/gameversion",
        },
        { source: "/cf-usersignup.asp", destination: "/api/game/signup" },
        { source: "/cf-usersignup.php", destination: "/api/game/signup" },
        { source: "/game/cf-usersignup.asp", destination: "/api/game/signup" },
        { source: "/game/cf-usersignup.php", destination: "/api/game/signup" },
        {
          source: "/gamefiles/cf-usersignup.asp",
          destination: "/api/game/signup",
        },
        { source: "/cf-userlogin.asp", destination: "/api/game/login-xml" },
        { source: "/cf-userlogin.php", destination: "/api/game/login-xml" },
        { source: "/game/cf-userlogin.asp", destination: "/api/game/login-xml" },
        { source: "/game/cf-userlogin.php", destination: "/api/game/login-xml" },
        {
          source: "/gamefiles/cf-userlogin.asp",
          destination: "/api/game/login-xml",
        },
        {
          source: "/gamefiles/cf-userlogin.php",
          destination: "/api/game/login-xml",
        },
        { source: "/quest.asp", destination: "/api/game/quest" },
        { source: "/game/quest.asp", destination: "/api/game/quest" },
        { source: "/travelmap.asp", destination: "/api/data/travelmap" },
        { source: "/gamefiles/travelmap.asp", destination: "/api/data/travelmap" },
        { source: "/getversion.asp", destination: "/api/data/gameversion" },
        { source: "/gameversion.asp", destination: "/api/data/gameversion" },
        { source: "/gameversion2.asp", destination: "/api/data/gameversion" },
        { source: "/game/getversion.asp", destination: "/api/data/gameversion" },
        { source: "/game/gameversion.asp", destination: "/api/data/gameversion" },
        {
          source: "/gamefiles/gameversion.asp",
          destination: "/api/data/gameversion",
        },
        { source: "/game/crossdomain.xml", destination: "/crossdomain.xml" },
      ],
      afterFiles: [],
      fallback: [],
    };
  },
};

export default nextConfig;
