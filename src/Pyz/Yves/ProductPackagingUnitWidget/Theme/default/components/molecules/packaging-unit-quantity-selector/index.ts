import './packaging-unit-quantity-selector.scss';
import register from 'ShopUi/app/registry';
export default register(
    'packaging-unit-quantity-selector',
    () => import(/* webpackMode: "eager" */ './packaging-unit-quantity-selector'),
);
