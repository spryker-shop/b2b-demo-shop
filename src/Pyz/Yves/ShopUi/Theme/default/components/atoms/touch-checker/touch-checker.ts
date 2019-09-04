import Component from 'ShopUi/models/component';

export default class TouchChecker extends Component {
    protected readyCallback(): void {}

    protected init(): void {
        this.touchInspectionInit();
    }

    protected touchInspectionInit(): void {
        const isTouch = 'ontouchstart' in window;

        if (isTouch) {
            document.body.classList.add('is-touch');
        }
    }
}
