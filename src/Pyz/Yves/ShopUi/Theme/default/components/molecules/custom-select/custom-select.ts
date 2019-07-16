import Component from 'ShopUi/models/component';
import $ from 'jquery/dist/jquery';
import select from 'select2';

const DROPDOWN_SELECTOR = 'body > .select2-container--open';

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
            const event = new Event('change');
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

        do {
            left += elementLeftOffset.offsetLeft || 0;
            elementLeftOffset = <HTMLElement>elementLeftOffset.offsetParent;
        } while(elementLeftOffset);

        return left;
    }

    protected initSelect(): void {
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
            this.querySelector('.select2-selection__rendered').removeAttribute('title');
        }
    }

    get configWidth(): string {
        return this.select.getAttribute('config-width');
    }

    get configTheme(): string {
        return this.select.getAttribute('config-theme');
    }

    get configDropdownAutoWidth(): boolean {
        return Boolean(this.select.getAttribute('config-dropdown-auto-width'));
    }

    get configDropdownRight(): boolean {
        return Boolean(this.select.getAttribute('config-dropdown-right'));
    }
}
