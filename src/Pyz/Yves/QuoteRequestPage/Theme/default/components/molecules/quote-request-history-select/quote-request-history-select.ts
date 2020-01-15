import Component from 'ShopUi/models/component';

export default class QuoteRequestHistorySelect extends Component {
    protected select: HTMLSelectElement;

    protected readyCallback(): void {}

    protected init(): void {
        this.select = <HTMLSelectElement>this.getElementsByTagName('select')[0];
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.select.addEventListener('change', (event: Event) => this.onChange());
    }

    protected onChange(): void {
        const VERSION_REFERENCE_TITLE = 'quote-request-version-reference';
        const selectedValue = this.select.options[this.select.selectedIndex].value;
        if (selectedValue) {
            window.location.search = `${VERSION_REFERENCE_TITLE}=${selectedValue}`;
        }
    }
}
