import './asset-finder.scss';
import register from 'ShopUi/app/registry';
export default register(
    'asset-finder',
    () =>
        import(
            /* webpackMode: "lazy" */
            /* webpackChunkName: "asset-finder" */
            'SelfServicePortal/components/molecules/asset-finder/asset-finder'
        ),
);
