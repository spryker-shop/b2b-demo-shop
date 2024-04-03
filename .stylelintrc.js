module.exports = {
    extends: ['stylelint-config-standard-scss', '@spryker/frontend-config.stylelint/.stylelintrc.json'],
    rules: {
        'scss/at-mixin-argumentless-call-parentheses': null,
        'scss/no-global-function-names': null,
        'declaration-block-no-redundant-longhand-properties': null,
        'scss/at-if-no-null': null,
        'scss/dollar-variable-pattern': null,
        'color-hex-length': 'long',
        'scss/dollar-variable-empty-line-before': null,
        'scss/at-import-partial-extension': null,
    },
};
