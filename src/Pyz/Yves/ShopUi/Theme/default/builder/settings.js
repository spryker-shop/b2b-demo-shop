const path = require('path');

const name = 'yves_default';
const theme = 'default';
const mode = process.argv.length > 2 ? process.argv[2] : 'development';
const watch = process.argv.length > 3 ? !!process.argv[3] : false;
const context = process.cwd();

const paths = {
    public: './public/Yves/assets',
    shop: './vendor/spryker/spryker-shop',
    ui: {
        shop: `./vendor/spryker/spryker-shop/Bundles/ShopUi/src/SprykerShop/Yves/ShopUi/Theme/${theme}`,
        project: `./src/Pyz/Yves/ShopUi/Theme/${theme}`
    }
};

module.exports = {
    name,
    theme,
    mode,
    watch,
    paths,

    dirs: {
        context,
        public: path.join(context, paths.public),
        shop: path.join(context, paths.shop),
        ui: {
            shop: path.join(context, paths.ui.shop),
            project: path.join(context, paths.ui.project)
        }
    },

    find: {
        components: {
            dirs: [
                path.join(context, paths.shop)
            ],
            patterns: [
                `**/Theme/${theme}/components/atoms/*/index.ts`,
                `**/Theme/${theme}/components/molecules/*/index.ts`,
                `**/Theme/${theme}/components/organisms/*/index.ts`,
                `**/Theme/${theme}/templates/*/index.ts`,
                `**/Theme/${theme}/views/*/index.ts`,
                '!config',
                '!data',
                '!deploy',
                '!node_modules',
                '!public',
                '!test'
            ]
        }
    }
}
