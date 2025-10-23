import './google-map.scss';
import register from 'ShopUi/app/registry';
export default register(
    'google-map',
    () =>
        import(
            /* webpackMode: "lazy" */
            /* webpackChunkName: "google-map" */
            'SelfServicePortal/components/molecules/google-map/google-map'
        ),
);
