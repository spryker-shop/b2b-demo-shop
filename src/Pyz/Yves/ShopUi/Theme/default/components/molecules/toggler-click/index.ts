import register from 'ShopUi/app/registry';
export default register('toggler-click', () => import(/* webpackMode: "lazy" */'./toggler-click'));
