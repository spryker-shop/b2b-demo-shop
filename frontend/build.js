const compiler = require('./libs/compiler');

// get the mode arg from `npm run xxx` script
// defined in package.json
const [mode] = process.argv.slice(2);

// register custom development configuration factory
const config = require(`./configs/${mode}`);

// build the project using the configuration factory
// associated with the provided mode
compiler.compile(config);
