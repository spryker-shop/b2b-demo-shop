import './test-component.scss';
import { register } from 'ShopUI/app';
export default register('test-component', () => import(/* webpackMode: "lazy" */'./test-component'));
