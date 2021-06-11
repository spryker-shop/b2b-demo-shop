import register from 'ShopUi/app/registry';
export default register('touch-checker', () => import(/* webpackMode: "eager" */ './touch-checker'));
