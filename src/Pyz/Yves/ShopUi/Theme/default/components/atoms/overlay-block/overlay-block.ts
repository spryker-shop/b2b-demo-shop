import Component from 'ShopUi/models/component';

export default class OverlayBlock extends Component {

    protected readyCallback(): void {}

    protected toggleModifire(modifire?: string, element?: HTMLElement, cssClass?: string): void {
        if(modifire) {
            element.classList.toggle(`${cssClass}--${modifire}`);
        }
    }

    protected toggleCondition(isOpen): boolean {
        if (isOpen !== undefined) {
            const isShown = this.classList.contains(this.classToShow);
            return (isOpen && !isShown) || (!isOpen && isShown);
        }
        return true;
    }

    toggleOverlay(modifire?: string, bodyModifire?: string, isOpen?: boolean): void {

        if(this.toggleCondition(isOpen)) {
            this.toggleModifire(modifire, this, this.name);
            this.toggleModifire(bodyModifire, document.body,'body-overlay');
            this.classList.toggle(this.classToShow);
        }

    }

    get classToShow(): string {
        return `${this.name}--is-shown`;
    }

}