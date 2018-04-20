const settings = require('../settings');
const ProductionConfigurationFactory = require(`${settings.dirs.ui.shop}/builder/configuration-factory.prod`);
const task = require(`${settings.dirs.ui.shop}/builder/libs/task`);

task(settings, ProductionConfigurationFactory);
