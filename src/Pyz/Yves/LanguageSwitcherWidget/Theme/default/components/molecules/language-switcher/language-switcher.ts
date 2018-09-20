import Component from 'ShopUi/models/component';

export default class LanguageSwitcher extends Component {
    readonly select: HTMLSelectElement;

    constructor() {
        super();
        this.select = <HTMLSelectElement>document.querySelector(`.${this.jsName}`);
    }

    protected readyCallback(): void {
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.select.addEventListener('change', () => this.onTriggerChange());
    }

    protected onTriggerChange(): void {
        if(this.hasUrl) {
            window.location.assign(this.value);
        }
    }

    get value(): string {
        return this.select.options[this.select.selectedIndex].value;
    }

    get hasUrl(): boolean {
        return !!this.value;
    }

}
