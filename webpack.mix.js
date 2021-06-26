const mix = require("laravel-mix");
const path = require("path");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

const {
  FORWARD_BROWSER_SYNC_PORT = 3000,
  FORWARD_BROWSER_SYNC_UI_PORT = 3001,
} = process.env;

mix.browserSync({
  host: "127.0.0.1",
  proxy: "localhost",
  port: FORWARD_BROWSER_SYNC_PORT,
  ui: {
    port: FORWARD_BROWSER_SYNC_UI_PORT,
  },
  open: false,
  files: [
    "app/**/*.php",
    "resources/views/**/*.php",
    "packages/mixdinternet/frontend/src/**/*.php",
    "public/js/**/*.js",
    "public/js/**/*.ts",
    "public/css/**/*.css",
  ],
});

mix
  .webpackConfig({
    entry: "./resources/js/app.ts",
    output: {
      filename: "js/app.js",
    },
    resolve: {
      extensions: [".tsx", ".ts", ".js", ".vue"],
      alias: {
        "@tv": path.resolve(__dirname, "resources/js/vue/src"),
      },
    },
    module: {
      rules: [
        {
          test: /\.(js|mjs|jsx|ts|tsx)$/,
          include: path.resolve(__dirname, "./resources/js"),
          loader: require.resolve("babel-loader"),
          options: {
            configFile: path.resolve(
              __dirname,
              "./_js-shared/_babel.config.js",
            ),
            cacheDirectory: true,
            cacheCompression: false,
            // compact: isEnvProduction,
          },
        },
      ],
    },
  })
  .vue()
  .postCss("resources/css/app.css", "public/css", [
    //
  ]);
