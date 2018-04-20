const settings = require('../settings');
const DevelopmenWatchConfigurationFactory = require(`${settings.dirs.ui.shop}/builder/configuration-factory.dev-watch`);
const task = require(`${settings.dirs.ui.shop}/builder/libs/task`);

task(settings, DevelopmenWatchConfigurationFactory);
