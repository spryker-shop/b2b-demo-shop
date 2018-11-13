import register from 'ShopUi/app/registry';
export default register('ui-less', () => import(/* webpackMode: "lazy" */'./ui-less'));
