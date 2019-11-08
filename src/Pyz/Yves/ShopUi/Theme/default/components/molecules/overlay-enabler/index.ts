import register from 'ShopUi/app/registry';
export default register('overlay-enabler', () => import(/* webpackMode: "eager" */'./overlay-enabler'));
