import './source-price-form.scss';
import register from 'ShopUi/app/registry';
export default register(
    'source-price-form',
    () =>
        import(
            /* webpackMode: "lazy" */
            /* webpackChunkName: "source-price-form" */
            './source-price-form'
        ),
);
