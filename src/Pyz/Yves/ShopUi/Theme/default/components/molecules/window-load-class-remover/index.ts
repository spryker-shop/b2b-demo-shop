import register from 'ShopUi/app/registry';
export default register(
    'window-load-class-remover',
    () => import(/* webpackMode: "eager" */ './window-load-class-remover'),
);
