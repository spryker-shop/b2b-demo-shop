import './input-dropzone.scss';
import register from 'ShopUi/app/registry';
export default register(
    'input-dropzone',
    () =>
        import(
            /* webpackMode: "lazy" */
            /* webpackChunkName: "input-dropzone" */
            'ShopUi/components/molecules/input-dropzone/input-dropzone'
        ),
);
