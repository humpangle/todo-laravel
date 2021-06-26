const { resolve: resolvePath } = require("path");

const jestBabelTransform = resolvePath(__dirname, "./_jest-babel-transform.js");
const jsDir = resolvePath(__dirname, "../resources/js");
const vueRootDir = `${jsDir}/vue`;

module.exports = {
    rootDir: vueRootDir,
    moduleFileExtensions: [
        "js",
        "jsx",
        "json",
        // tell Jest to handle *.vue files
        "vue",
        "ts",
        "tsx",
    ],
    transform: {
        "^.+\\.vue$": require.resolve("vue-jest"),
        ".+\\.(css|styl|less|sass|scss|svg|png|jpg|ttf|woff|woff2)$":
            require.resolve("jest-transform-stub"),
        "^.+\\.(js|jsx|mjs|cjs|ts|tsx)$": jestBabelTransform,
    },
    transformIgnorePatterns: ["/node_modules/"],
    // support the same @ -> src alias mapping in source code
    moduleNameMapper: {
        "^@/(.*)$": "<rootDir>/src/$1",
    },
    testEnvironment: "jest-environment-jsdom-fifteen",
    // serializer for snapshots
    snapshotSerializers: ["jest-serializer-vue"],
    testMatch: [
        "**/tests/unit/**/*.test.[jt]s?(x)",
        "**/__tests__/*.[jt]s?(x)",
    ],
    // https://github.com/facebook/jest/issues/6766
    testURL: "http://localhost/",
    watchPlugins: [
        require.resolve("jest-watch-typeahead/filename"),
        require.resolve("jest-watch-typeahead/testname"),
    ],
    watchPathIgnorePatterns: [
        "<rootDir>/coverage/",
        "<rootDir>/service-worker.+",
        "<rootDir>/serviceWorkerRegistration.*",
    ],
};
