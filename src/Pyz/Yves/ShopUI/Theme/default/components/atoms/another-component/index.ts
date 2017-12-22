import './another-component.scss';
import { register } from 'ShopUI/app';
export default register('another-component', () => import(/* webpackMode: "lazy" */'./another-component'));
