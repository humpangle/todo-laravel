const { resolve: resolvePath } = require("path");
const deepMerge = require("deepmerge");
const vueTsJestDefaultPreset = require("@vue/cli-plugin-unit-jest/presets/typescript-and-babel/jest-preset.js");

const jsDir = resolvePath(__dirname, "../resources/js");
const vueRootDir = `${jsDir}/vue`;

const vueJestConfig = deepMerge(vueTsJestDefaultPreset, {
  rootDir: vueRootDir,
  transform: {
    "^.+\\.vue$": require.resolve("vue-jest"),
  },
  testMatch: ["**/tests/unit/**/*.test.[jt]s?(x)", "**/__tests__/*.[jt]s?(x)"],
  moduleNameMapper: {
    "^@tv/(.*)$": "<rootDir>/src/$1",
  },
  globals: {
    "ts-jest": {
      // there must be a `babel.config.js` at project root. Providing the path
      // to a custom babel config or babel config object here does not work,
      // even though the documentation for ts-jest states that it should work
      babelConfig: true,
    },
  },
});

module.exports = vueJestConfig;
