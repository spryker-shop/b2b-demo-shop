import register from 'ShopUi/app/registry';
export default register('ordered-configured-bundle', () => import(/* webpackMode: "lazy" */'./ordered-configured-bundle'));
import './ordered-configured-bundle.scss';
