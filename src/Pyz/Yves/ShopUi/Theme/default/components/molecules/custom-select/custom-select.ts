import Component from 'ShopUi/models/component';
import $ from 'jquery/dist/jquery';
import select from 'select2';

export default class CustomSelect extends Component {
    select: HTMLSelectElement;
    $select: $;
    mobileResolution: number = 768;
    isInited: boolean = false;
    protected timeout: number = 300;

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
        window.addEventListener('resize', () => setTimeout(() => this.initSelect(), this.timeout));
    }

    protected onChangeSelect(): void {
        if (this.isInited) {
            const event = new Event('change');
            this.select.dispatchEvent(event);
            this.removeAttributeTitle();
        }
    }

    protected initSelect(): void {
        if (window.innerWidth >= this.mobileResolution && !this.isInited) {
            this.isInited = true;
            this.$select.select2({
                minimumResultsForSearch: Infinity,
                width: this.configWidth,
                theme: this.configTheme
            });
        } else if (window.innerWidth < this.mobileResolution && this.isInited) {
            this.isInited = false;
            this.$select.select2('destroy');
        }
    }

    protected removeAttributeTitle(): void {
        if (this.isInited) {
            this.querySelector('.select2-selection__rendered').removeAttribute('title');
        }
    }

    get configWidth(): string {
        return this.select.getAttribute('config-width');
    }

    get configTheme(): string {
        return this.select.getAttribute('config-theme');
    }
}
