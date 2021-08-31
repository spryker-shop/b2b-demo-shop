import './mini-cart-radio.scss';
import register from 'ShopUi/app/registry';
export default register(
    'mini-cart-radio',
    () =>
        import(
            /* webpackMode: "lazy" */
            /* webpackChunkName: "mini-cart-radio" */
            'MultiCartWidget/components/molecules/mini-cart-radio/mini-cart-radio'
        ),
);
