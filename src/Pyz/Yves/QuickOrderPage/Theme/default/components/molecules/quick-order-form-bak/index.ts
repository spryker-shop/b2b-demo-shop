import './quick-order-form.scss';
import register from 'ShopUi/app/registry';
export default register('quick-order-form', () => import(/* webpackMode: "lazy" */'SprykerShop/quick-order-page/src/SprykerShop/Yves/QuickOrderPage/Theme/default/components/molecules/quick-order-form/quick-order-form'));
