import register from 'ShopUi/app/registry';
export default register('toggler-accordion', () => import(/* webpackMode: "lazy" */'./toggler-accordion'));
import './toggler-accordion.scss';