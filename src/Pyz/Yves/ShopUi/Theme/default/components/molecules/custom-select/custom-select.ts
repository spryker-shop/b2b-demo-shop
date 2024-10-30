import Component from 'ShopUi/models/component';
import $ from 'jquery/dist/jquery';
import 'select2';

const DROPDOWN_SELECTOR = 'body > .select2-container--open';

export default class CustomSelect extends Component {
    protected select: HTMLSelectElement;
    protected $select: $;
    protected mobileResolution = 768;
    protected isInited = false;
    protected timeout = 300;

    protected readyCallback(): void {}

    protected init(): void {
        this.select = <HTMLSelectElement>this.getElementsByClassName(`${this.jsName}`)[0];
        this.$select = $(this.select);

        this.mapEvents();

        if (this.autoInit) {
            this.initSelect();
            this.removeAttributeTitle();
        }
    }

    protected mapEvents(): void {
        this.changeSelectEvent();
        if (this.configDropdownRight) {
            this.$select.on('select2:open', () => {
                this.changeDropdownPosition();
                window.addEventListener('resize', () => this.changeDropdownPosition());
            });
        }
        window.addEventListener('resize', () => setTimeout(() => this.initSelect(), this.timeout));
    }

    protected onChangeSelect(): void {
        if (this.isInited) {
            const event = new Event('change', { bubbles: true });
            this.select.dispatchEvent(event);
            this.removeAttributeTitle();
        }
    }

    protected changeDropdownPosition(): void {
        const dropdown = <HTMLElement>document.querySelector(DROPDOWN_SELECTOR);
        const rightPosition = window.innerWidth - this.absoluteOffsetLeft() - this.clientWidth;
        dropdown.style.right = `${rightPosition}px`;
    }

    protected absoluteOffsetLeft(): number {
        let elementLeftOffset = <HTMLElement>this;
        let left = 0;

        while (elementLeftOffset) {
            left += elementLeftOffset.offsetLeft;
            elementLeftOffset = <HTMLElement>elementLeftOffset.offsetParent;
        }

        return left;
    }

    changeSelectEvent(): void {
        this.$select.on('select2:select', () => this.onChangeSelect());
    }

    initSelect(): void {
        if (window.innerWidth >= this.mobileResolution && !this.isInited) {
            this.isInited = true;
            this.$select.select2({
                minimumResultsForSearch: Infinity,
                width: this.configWidth,
                theme: this.configTheme,
                dropdownAutoWidth: this.configDropdownAutoWidth,
            });
        } else if (window.innerWidth < this.mobileResolution && this.isInited) {
            this.isInited = false;
            this.$select.select2('destroy');
        }
    }

    protected removeAttributeTitle(): void {
        if (this.isInited) {
            this.getElementsByClassName('select2-selection__rendered')[0].removeAttribute('title');
        }
    }

    protected get configWidth(): string {
        return this.select.getAttribute('config-width');
    }

    protected get configTheme(): string {
        return this.select.getAttribute('config-theme');
    }

    protected get configDropdownAutoWidth(): boolean {
        return Boolean(this.select.getAttribute('config-dropdown-auto-width'));
    }

    protected get configDropdownRight(): boolean {
        return Boolean(this.select.getAttribute('config-dropdown-right'));
    }

    protected get autoInit(): boolean {
        return this.select.hasAttribute('auto-init');
    }
}
