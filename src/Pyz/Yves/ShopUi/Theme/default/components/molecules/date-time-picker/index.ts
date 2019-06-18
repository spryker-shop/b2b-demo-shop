import 'jquery-datetimepicker/build/jquery.datetimepicker.min.css';
import register from 'ShopUi/app/registry';
export default register('date-time-picker', () => import(/* webpackMode: "lazy" */'./date-time-picker'));
