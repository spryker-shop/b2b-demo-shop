import Component from 'ShopUi/models/component';

export default class OverlayBlock extends Component {

    protected readyCallback(): void {}

    protected addModifire(modifire?: string, element?: HTMLElement, cssClass?: string): void {
        if(modifire) {
            element.classList.add(`${cssClass}--${modifire}`);
        }
    }

    protected removeModifire(modifire?: string, element?: HTMLElement, cssClass?: string): void {
        if(modifire) {
            element.classList.remove(`${cssClass}--${modifire}`);
        }
    }

    showOverlay(modifire?: string, bodyModifire?: string): void {
        this.addModifire(modifire, this, this.name);
        this.addModifire(bodyModifire, document.body,'body-overlay');
        this.classList.add(this.classToShow);
    }

    hideOverlay(modifire?: string, bodyModifire?: string): void {
        this.removeModifire(modifire, this, this.name);
        this.removeModifire(bodyModifire, document.body,'body-overlay');
        this.classList.remove(this.classToShow);
    }

    get classToShow(): string {
        return `${this.name}--is-shown`;
    }

}