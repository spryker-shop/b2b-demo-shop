import './quick-order-row.scss';
import register from 'ShopUi/app/registry';
export default register(
    'quick-order-row',
    () =>
        import(
            /* webpackMode: "lazy" */
            /* webpackChunkName: "quick-order-row" */
            './quick-order-row'
        ),
);
