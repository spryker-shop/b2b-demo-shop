const path = require('path');
const appSettings = require('../settings');

function getFromTsConfig() {
    const tsConfigFile = path.join(appSettings.context, appSettings.paths.tsConfig);
    const tsConfig = require(tsConfigFile);
    const aliases = tsConfig.compilerOptions.paths;

    return Object.keys(aliases).reduce((map, name) => {
        if (name === '*') {
            return map;
        }

        if (aliases[name].length === 0) {
            return map;
        }

        const alias = name.replace(/(\/\*?)$/, '');
        const aliasPath = aliases[name][0].replace(/(\/\*?)$/, '');
        const aliasDir = path.join(appSettings.context, aliasPath);
        map[alias] = aliasDir;
        return map;
    }, {});
}

module.exports = {
    getFromTsConfig
}
