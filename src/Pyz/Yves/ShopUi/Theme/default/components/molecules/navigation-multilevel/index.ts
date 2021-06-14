import register from 'ShopUi/app/registry';
export default register(
    'navigation-multilevel',
    () =>
        import(
            /* webpackMode: "lazy" */
            /* webpackChunkName: "navigation-multilevel" */
            './navigation-multilevel'
        ),
);
