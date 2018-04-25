const path = require('path');

const name = 'yves_default';
const theme = 'default';
const context = process.cwd();

const paths = {
    public: './public/Yves/assets',
    shop: './vendor/spryker-shop',
    ui: {
        shop: `./vendor/spryker-shop/shop-ui/src/SprykerShop/Yves/ShopUi/Theme/${theme}`,
        project: `./src/Pyz/Yves/ShopUi/Theme/${theme}`
    }
};

module.exports = {
    name,
    theme,
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
        componentEntryPoints: {
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
        },

        componentStyles: {
            dirs: [
                path.join(context, paths.shop)
            ],
            patterns: [
                `**/Theme/${theme}/components/atoms/*/*.scss`,
                `**/Theme/${theme}/components/molecules/*/*.scss`,
                `**/Theme/${theme}/components/organisms/*/*.scss`,
                `**/Theme/${theme}/templates/*/*.scss`,
                `**/Theme/${theme}/views/*/*.scss`,
                `!**/Theme/${theme}/**/style.scss`,
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
