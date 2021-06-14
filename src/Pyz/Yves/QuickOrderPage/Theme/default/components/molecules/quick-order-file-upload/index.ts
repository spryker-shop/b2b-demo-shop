import './quick-order-file-upload.scss';
import register from 'ShopUi/app/registry';
export default register(
    'quick-order-file-upload',
    () => import(/* webpackMode: "eager" */ './quick-order-file-upload'),
);
