import SourcePriceFormParentClass from 'QuoteRequestAgentPage/components/molecules/source-price-form/source-price-form';

export default class SourcePriceForm extends SourcePriceFormParentClass {
    protected price: HTMLElement;
    protected originPrice: HTMLElement;
    readonly hiddenClass: string = 'is-hidden';

    protected readyCallback(): void {
        this.price = <HTMLElement>this.querySelector(`.${this.jsName}__price`);
        this.originPrice = <HTMLElement>this.querySelector(`.${this.jsName}__origin-price`);
        super.readyCallback();
    }

    protected onInputType(event: Event): void {
        super.onInputType(event);

        if (this.checkboxChecked) {
            this.price.classList.remove(this.hiddenClass);
            this.originPrice.classList.add(this.hiddenClass);
        }
    }

    protected onCheckboxChange(event: Event): void {
        super.onCheckboxChange(event);

        if (this.checkboxChecked) {
            this.price.classList.remove(this.hiddenClass);
            this.originPrice.classList.add(this.hiddenClass);

            return;
        }

        this.price.classList.add(this.hiddenClass);
        this.originPrice.classList.remove(this.hiddenClass);
    }
}
