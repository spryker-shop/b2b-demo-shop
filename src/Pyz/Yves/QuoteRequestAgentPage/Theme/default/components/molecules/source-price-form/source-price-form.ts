import SourcePriceFormParentClass from 'QuoteRequestAgentPage/components/molecules/source-price-form/source-price-form';

export default class SourcePriceForm extends SourcePriceFormParentClass {
    protected price: HTMLElement;
    protected originPrice: HTMLElement;
    protected readonly hiddenClass: string = 'is-hidden';

    protected readyCallback(): void {
        this.price = <HTMLElement>this.querySelector(`.${this.jsName}__price`);
        this.originPrice = <HTMLElement>this.querySelector(`.${this.jsName}__origin-price`);
        super.readyCallback();
    }

    protected togglePriceVisibility(): void {
        this.price.classList.toggle(this.hiddenClass);
        this.originPrice.classList.toggle(this.hiddenClass);
    }

    protected onInputType(event: Event): void {
        super.onInputType(event);

        if (this.checkboxChecked) {
            this.togglePriceVisibility();
        }
    }

    protected onCheckboxChange(event: Event): void {
        super.onCheckboxChange(event);

        if (this.checkboxChecked) {
            this.togglePriceVisibility();

            return;
        }

        this.togglePriceVisibility();
    }
}
