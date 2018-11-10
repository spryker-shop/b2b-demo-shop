import register from 'ShopUi/app/registry';
export default register('filter-category', () => import(/* webpackMode: "lazy" */'./filter-category'));
import './filter-category.scss';
