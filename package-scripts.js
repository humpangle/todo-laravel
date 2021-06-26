module.exports = {
  scripts: {
    dev: "mix",
    watch: "mix watch",
    watchPoll: "mix watch -- --watch-options-poll=1000",
    hot: "mix watch --hot",
    prod: "mix --production",
    p: {
      default: "prettier --write .",
      description: "prettier all",
    },
    ...vueScripts(),
    ...phpScripts(),
  },
};

function vueScripts() {
  return {
    vue: {
      t: {
        default: "vue-cli-service test:unit --watch",
        t: "vue-cli-service test:unit",
      },
      lint: {
        default: "vue-cli-service lint",
      },
      p: {
        default: "prettier --write ./resources/js/vue",
      },
      tc: {
        default: "tsc --noEmit --project .",
      },
      cy: {
        default: "vue-cli-service test:e2e",
      },
    },
  };
}

function phpScripts() {
  const chokidarOptionsPhpTestCmd = `
chokidar \
    "app/**/*.php" \
    "routes/**/*.php" \
    "resources/views/**/*.php"  \
    "database/factories/**/*.php"  \
    "tests/**/*.php" \
  --ignore "app/Http/Middleware/**" \
  --ignore "app/Providers/**" \
  --ignore "app/Console/Kernel.php" \
  --ignore "routes/console.php" \
  --initial
`.trim();

  const phpTestCmd = "./vendor/bin/sail artisan test --exclude skip";

  return {
    php: {
      t: {
        default: `${chokidarOptionsPhpTestCmd} -c "clear && ${phpTestCmd}"`,
        description: "test watch php",
      },
    },
  };
}
