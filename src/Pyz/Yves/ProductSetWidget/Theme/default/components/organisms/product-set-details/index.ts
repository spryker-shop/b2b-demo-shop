import './product-set-details.scss';
import register from 'ShopUi/app/registry';
export default register(
    'product-set-details',
    () =>
        import(
            /* webpackMode: "lazy" */
            /* webpackChunkName: "product-set-details" */
            'ProductSetWidget/components/organisms/product-set-details/product-set-details'
        ),
);
