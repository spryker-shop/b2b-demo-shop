import SourcePriceFormParentClass from 'QuoteRequestAgentPage/components/molecules/source-price-form/source-price-form';

export default class SourcePriceForm extends SourcePriceFormParentClass {
    protected price: HTMLElement;
    protected originPrice: HTMLElement;
    protected readonly hiddenClass: string = 'is-hidden';

    protected init(): void {
        this.price = <HTMLElement>this.getElementsByClassName(`${this.jsName}__price`)[0];
        this.originPrice = <HTMLElement>this.getElementsByClassName(`${this.jsName}__origin-price`)[0];
        super.init();
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
        this.togglePriceVisibility();
    }
}
