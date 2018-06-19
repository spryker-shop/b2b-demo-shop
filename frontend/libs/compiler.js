const webpack = require('webpack');

function compile(config) {
    console.log(`Building for ${config.mode}...`);

    if (config.watch) {
        console.log('Watch mode: ON');
    }

    webpack(config, (err, stats) => {
        if (err) {
            console.error(err.stack || err);

            if (err.details) {
                console.error(err.details);
            }

            return;
        }

        console.log(stats.toString(config.stats), '\n');
    });
}

module.exports = {
    compile
}
