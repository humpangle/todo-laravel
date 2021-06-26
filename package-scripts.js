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
  },
};
