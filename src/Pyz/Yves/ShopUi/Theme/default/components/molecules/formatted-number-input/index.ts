import './formatted-number-input.scss';
import register from 'ShopUi/app/registry';
export default register(
    'formatted-number-input',
    () => import(/* webpackMode: "lazy" */ 'ShopUi/components/molecules/formatted-number-input/formatted-number-input'),
);
