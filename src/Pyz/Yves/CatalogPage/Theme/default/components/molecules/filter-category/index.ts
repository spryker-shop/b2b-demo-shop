import './filter-category.scss';
import register from 'ShopUi/app/registry';
export default register(
    'filter-category',
    () =>
        import(
            /* webpackMode: "lazy" */
            /* webpackChunkName: "filter-category" */
            './filter-category'
        ),
);
