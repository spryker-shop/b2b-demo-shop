import './quote-request-autocomplete-form.scss';
import register from 'ShopUi/app/registry';
export default register(
    'quote-request-autocomplete-form',
    () =>
        import(
            /* webpackMode: "lazy" */
            /* webpackChunkName: "quote-request-autocomplete-form" */
            './quote-request-autocomplete-form'
        ),
);
