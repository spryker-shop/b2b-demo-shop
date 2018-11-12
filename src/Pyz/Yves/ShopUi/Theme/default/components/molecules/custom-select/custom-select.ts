import Component from 'ShopUi/models/component';
import $ from 'jquery';
import select from 'select2';

export default class CustomSelect extends Component {

    select: HTMLSelectElement
    $select: $

    protected readyCallback(): void {

        const select2 = select;
        this.select = <HTMLSelectElement>this.querySelector(`.${this.jsName}`);
        this.$select = $(this.select);

        this.mapEvents();
        this.initSelect();
        this.removeAttributeTitle();
    }

    protected mapEvents(): void {
        this.$select.on('select2:select', () => this.onChangeSelect());
    }

    protected onChangeSelect(): void {
        const event = new Event('change');
        this.select.dispatchEvent(event);
        this.removeAttributeTitle();
    }

    protected initSelect(): void {
        this.$select.select2({
            minimumResultsForSearch: Infinity,
            width: this.configWidth,
            theme: this.configTheme
        });
    }

    protected removeAttributeTitle(): void {
        this.querySelector('.select2-selection__rendered').removeAttribute('title');
    }

    get configWidth(): string {
        return this.select.getAttribute('config-width');
    }

    get configTheme(): string {
        return this.select.getAttribute('config-theme');
    }
}
