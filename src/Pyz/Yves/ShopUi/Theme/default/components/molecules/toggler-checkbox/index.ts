import './toggler-checkbox.scss';
import register from 'ShopUi/app/registry';
export default register(
    'toggler-checkbox',
    () =>
        import(
            /* webpackMode: "lazy" */
            /* webpackChunkName: "toggler-checkbox" */
            './toggler-checkbox'
        ),
);
