import register from 'ShopUi/app/registry';
export default register(
    'validate-next-checkout-step',
    () =>
        import(
            /* webpackMode: "lazy" */
            /* webpackChunkName: "validate-next-checkout-step" */
            './validate-next-checkout-step'
        ),
);
