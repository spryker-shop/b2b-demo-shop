import Component from 'ShopUi/models/component';

export default class QuoteRequestHistorySelect extends Component {
    protected select: HTMLSelectElement;

    protected readyCallback(): void {
        this.select = <HTMLSelectElement>this.querySelector('select');
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.select.addEventListener('change', (event: Event) => this.onChange());
    }

    protected onChange(): void {
        const selectedValue = this.select.options[this.select.selectedIndex].value;
        if (selectedValue) {
            window.location.search = `quote-request-version-reference=${selectedValue}`;
        }
    }
}
