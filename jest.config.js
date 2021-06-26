const { resolve: resolvePath } = require("path");

const config = require(resolvePath(__dirname, "_js-shared/_jest.config.js"));

module.exports = {
  ...config,
};
