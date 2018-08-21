import './style';
import register from 'ShopUi/app/registry';
export default register('overlay-block', () => import(/* webpackMode: "lazy" */'./overlay-block'));