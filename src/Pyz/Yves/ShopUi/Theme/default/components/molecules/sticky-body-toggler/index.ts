import register from 'ShopUi/app/registry';
export default register(
    'sticky-body-toggler',
    () =>
        import(
            /* webpackMode: "lazy" */
            /* webpackChunkName: "sticky-body-toggler" */
            './sticky-body-toggler'
        ),
);
