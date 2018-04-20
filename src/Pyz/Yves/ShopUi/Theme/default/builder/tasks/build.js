const settings = require('../settings');
const DevelopmentConfigurationFactory = require(`${settings.dirs.ui.shop}/builder/configuration-factory.dev`);
const task = require(`${settings.dirs.ui.shop}/builder/libs/task`);

task(settings, DevelopmentConfigurationFactory);
