import register from 'ShopUi/app/registry';
export default register(
    'remote-form-submit',
    () =>
        import(
            /* webpackMode: "lazy" */
            /* webpackChunkName: "remote-form-submit" */
            './remote-form-submit'
        ),
);
