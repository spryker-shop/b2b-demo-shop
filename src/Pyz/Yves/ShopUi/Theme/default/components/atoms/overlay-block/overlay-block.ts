import Component from 'ShopUi/models/component';

export default class OverlayBlock extends Component {

    protected readyCallback(): void {}

    protected toggleModifire(modifire?: string, element?: HTMLElement, cssClass?: string): void {
        if(modifire) {
            element.classList.toggle(`${cssClass}--${modifire}`);
        }
    }

    toggleOverlay(modifire?: string, bodyModifire?: string): void {
        this.toggleModifire(modifire, this, this.name);
        this.toggleModifire(bodyModifire, document.body,'body-overlay');
        this.classList.toggle(this.classToShow);
    }

    get classToShow(): string {
        return `${this.name}--is-shown`;
    }

}