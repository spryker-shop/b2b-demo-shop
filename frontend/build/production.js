const builder = require('@spryker/suite-frontend-builder');
const factory = require('@spryker/suite-frontend-builder/dist/configuration-factory/production');
const settings = require('../settings');

builder.build(settings, factory.ProductionConfigurationFactory);
