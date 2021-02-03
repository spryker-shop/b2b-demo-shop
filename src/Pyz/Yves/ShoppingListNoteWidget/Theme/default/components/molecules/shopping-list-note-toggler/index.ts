import './shopping-list-note-toggler.scss';
import register from 'ShopUi/app/registry';
export default register(
    'shopping-list-note-toggler',
    () =>
        import(
            /* webpackMode: "lazy" */
            /* webpackChunkName: "shopping-list-note-toggler" */
            './shopping-list-note-toggler'
        ),
);
