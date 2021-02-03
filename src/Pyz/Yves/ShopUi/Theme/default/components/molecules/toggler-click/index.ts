import register from 'ShopUi/app/registry';
export default register(
    'toggler-click',
    () =>
        import(
            /* webpackMode: "lazy" */
            /* webpackChunkName: "toggler-click" */
            './toggler-click'
        ),
);
