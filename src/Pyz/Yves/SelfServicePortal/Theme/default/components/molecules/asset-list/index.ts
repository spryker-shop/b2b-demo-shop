import './asset-list.scss';
import register from 'ShopUi/app/registry';
export default register(
    'asset-list',
    () =>
        import(
            /* webpackMode: "lazy" */
            /* webpackChunkName: "asset-list" */
            'SelfServicePortal/components/molecules/asset-list/asset-list'
        ),
);
