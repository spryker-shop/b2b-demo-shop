import './asset-finder.scss';
import register from 'ShopUi/app/registry';
export default register(
    'asset-finder',
    () =>
        import(
            /* webpackMode: "lazy" */
            /* webpackChunkName: "asset-finder" */
            './asset-finder'
        ),
);
