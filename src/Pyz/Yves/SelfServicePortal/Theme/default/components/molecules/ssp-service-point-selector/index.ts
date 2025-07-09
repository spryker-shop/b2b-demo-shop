import './ssp-service-point-selector.scss';
import register from 'ShopUi/app/registry';
export default register(
    'ssp-service-point-selector',
    () =>
        import(
            /* webpackMode: "lazy" */
            /* webpackChunkName: "ssp-service-point-selector" */
            './ssp-service-point-selector'
        ),
);
