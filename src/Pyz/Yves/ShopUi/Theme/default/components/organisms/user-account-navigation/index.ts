import './user-account-navigation.scss';
import register from 'ShopUi/app/registry';
export default register('side-drawer', () => import(/* webpackMode: "eager" */'../side-drawer/side-drawer'));
