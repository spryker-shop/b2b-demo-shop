import './cart-item-note.scss';
import register from 'ShopUi/app/registry';
export default register(
    'cart-item-note',
    () =>
        import(
            /* webpackMode: "lazy" */
            /* webpackChunkName: "cart-item-note" */
            './cart-item-note'
        ),
);
