import PackagingUnitQuantitySelectorCore from 'ProductPackagingUnitWidget/components/molecules/packaging-unit-quantity-selector/packaging-unit-quantity-selector';

const HIDDEN_CLASS_NAME = 'is-hidden';

export default class PackagingUnitQuantitySelector extends PackagingUnitQuantitySelectorCore {
    protected eventInput: Event = new Event('input');

    protected initFormDefaultValues(): void {
        super.initFormDefaultValues();

        this.triggerInputEvent(this.qtyInSalesUnitInput);
    }

    protected onMeasurementUnitInputChange(event: Event): void {
        const salesUnitId = parseInt((<HTMLSelectElement>event.currentTarget).value);
        const salesUnit = this.getSalesUnitById(salesUnitId);
        let qtyInSalesUnits = this.formattedQtyInSalesUnitInput.unformattedValue;
        const qtyInBaseUnits = this.multiply(qtyInSalesUnits, this.currentSalesUnit.conversion);
        this.currentSalesUnit = salesUnit;
        qtyInSalesUnits = this.convertBaseUnitsAmountToCurrentSalesUnitsAmount(qtyInBaseUnits);

        if (isFinite(qtyInSalesUnits)) {
            this.qtyInSalesUnitInput.value = String(this.round(qtyInSalesUnits, this.decimals));
            this.triggerInputEvent(this.qtyInSalesUnitInput);
        }

        this.qtyInputChange(qtyInSalesUnits);
    }

    protected selectAmount(amountInBaseUnits: number, amountInSalesUnits: number): void {
        this.amountInSalesUnitInput.value = String(amountInSalesUnits);
        this.triggerInputEvent(this.amountInSalesUnitInput);
        this.amountInBaseUnitInput.value = String(amountInBaseUnits);
        if (!this.muError && !this.isAddToCartDisabled) {
            this.addToCartButton.removeAttribute('disabled');
        }
        this.puChoiceElement.classList.add(HIDDEN_CLASS_NAME);
        this.onAmountInputChange();
    }

    protected onLeadSalesUnitSelectChange(event: Event): void {
        const salesUnitId = parseInt((<HTMLSelectElement>event.currentTarget).value);
        const salesUnit = this.getLeadSalesUnitById(salesUnitId);

        const amountInSalesUnits = this.getAmountConversion(
            this.formattedAmountInSalesUnitInput.unformattedValue,
            salesUnit.conversion,
        );
        const amountInSalesUnitsMin = this.getAmountConversion(
            Number(this.amountInSalesUnitInput.min),
            salesUnit.conversion,
        );
        const amountInSalesUnitsMax = this.getAmountConversion(
            Number(this.amountInSalesUnitInput.max),
            salesUnit.conversion,
        );
        const amountInSalesUnitsStep = this.getAmountConversion(
            Number(this.amountInSalesUnitInput.step),
            salesUnit.conversion,
        );

        this.currentLeadSalesUnit = salesUnit;
        this.amountInSalesUnitInput.value = String(amountInSalesUnits);
        this.triggerInputEvent(this.amountInSalesUnitInput);

        if (this.amountInSalesUnitInput.min) {
            this.amountInSalesUnitInput.min = String(amountInSalesUnitsMin);
        }

        if (this.amountInSalesUnitInput.max) {
            this.amountInSalesUnitInput.max = String(amountInSalesUnitsMax);
        }

        if (this.amountInSalesUnitInput.step) {
            this.amountInSalesUnitInput.step = String(amountInSalesUnitsStep);
        }

        this.onAmountInputChange(amountInSalesUnits);
    }

    protected multiply(a: number, b: number): number {
        const result = a * b;
        const precision = 1000;

        return Math.round(result * precision) / precision;
    }

    protected triggerInputEvent(input: HTMLInputElement): void {
        input.dispatchEvent(this.eventInput);
    }
}
