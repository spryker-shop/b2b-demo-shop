import './style';
import register from 'ShopUi/app/registry';

export default register(
    'product-card',
    () => import(/* webpackMode: "lazy" */'./product-card')
);
