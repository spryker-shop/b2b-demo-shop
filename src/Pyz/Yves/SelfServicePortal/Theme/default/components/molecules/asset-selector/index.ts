import './asset-selector.scss';
import register from 'ShopUi/app/registry';
export default register(
    'asset-selector',
    () =>
        import(
            /* webpackMode: "lazy" */
            /* webpackChunkName: "asset-selector" */
            'SelfServicePortal/components/molecules/asset-selector/asset-selector'
        ),
);
