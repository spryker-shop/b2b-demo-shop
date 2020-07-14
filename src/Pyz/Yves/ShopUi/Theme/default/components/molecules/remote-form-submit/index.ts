import './remote-form-submit.scss';
import register from 'ShopUi/app/registry';
export default register(
    'remote-form-submit',
    () => import(/* webpackMode: "lazy" */'ShopUi/components/molecules/remote-form-submit/remote-form-submit')
);
