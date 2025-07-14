import './address-item-form-field-list.scss';
import register from 'ShopUi/app/registry';
export default register(
    'address-item-form-field-list',
    () =>
        import(
            /* webpackMode: "lazy" */
            /* webpackChunkName: "address-item-form-field-list" */
            './address-item-form-field-list'
        ),
);
