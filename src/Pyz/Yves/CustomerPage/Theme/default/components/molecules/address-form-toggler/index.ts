import register from 'ShopUi/app/registry';
export default register(
    'address-form-toggler',
    () =>
        import(
            /* webpackMode: "lazy" */
            /* webpackChunkName: "address-form-toggler" */
            './address-form-toggler'
        ),
);
