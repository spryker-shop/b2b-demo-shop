import Component from 'ShopUi/models/component';

export default class WindowLoadClassRemover extends Component {
    protected targetWrapper: HTMLElement;

    protected readyCallback() {}

    protected init(): void {
        this.targetWrapper = <HTMLElement>document.getElementsByClassName(this.targetClass)[0];

        this.mapEvents();
    }

    protected mapEvents(): void {
        window.addEventListener('load', () => this.onWindowLoad());
    }

    protected onWindowLoad(): void {
        this.targetWrapper.classList.remove(this.triggerClass);
    }

    protected get targetClass(): string {
        return this.getAttribute('target-class-name');
    }

    protected get triggerClass(): string {
        return this.getAttribute('trigger-class-name');
    }
}
