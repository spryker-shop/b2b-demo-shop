const path = require('path');
const glob = require('fast-glob');
const appSettings = require('../settings');

const defaultGlobSettings = {
    followSymlinkedDirectories: false,
    absolute: true,
    onlyFiles: true,
    onlyDirectories: false
}

function find(globDirs, globPatterns, globSettings = {}) {
    return globDirs.reduce((results, dir) => [
        ...results,
        ...glob.sync(globPatterns, {
            ...defaultGlobSettings,
            ...globSettings,
            cwd: dir
        })
    ], []);
}

function findComponentEntryPoints() {
    process.stdout.write('Scanning for component entry points...');
    const settings = appSettings.find.componentEntryPoints;
    const files = find(settings.dirs, settings.patterns, settings.globSettings);

    const entryPoints = Object.values(files.reduce((map, file) => {
        const dir = path.dirname(file);
        const name = path.basename(dir);
        const type = path.basename(path.dirname(dir));
        map[`${type}/${name}`] = file;
        return map;
    }, {}));

    console.log(`${entryPoints.length} found`);
    return entryPoints;
}

function findComponentStyles() {
    process.stdout.write('Scanning for component styles... ');
    const settings = appSettings.find.componentStyles;
    const styles = find(settings.dirs, settings.patterns, settings.globSettings);

    console.log(`${styles.length} found`);
    return styles;
}

module.exports = {
    findComponentEntryPoints,
    findComponentStyles
}
