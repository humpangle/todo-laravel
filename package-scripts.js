const phpTestCmd = `
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
  --initial \
  -c "./vendor/bin/sail artisan test --exclude skip"
`.trim();

module.exports = {
  scripts: {
    dev: "mix",
    watch: "mix watch",
    watchPoll: "mix watch -- --watch-options-poll=1000",
    hot: "mix watch --hot",
    prod: "mix --production",
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
    php: {
      t: {
        default: phpTestCmd,
        description: "test watch php",
      },
    },
    p: {
      default: "prettier --write .",
      description: "prettier all",
    },
  },
};
