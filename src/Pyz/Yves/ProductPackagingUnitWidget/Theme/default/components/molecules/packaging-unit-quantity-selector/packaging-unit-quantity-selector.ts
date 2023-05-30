import PackagingUnitQuantitySelectorCore from 'ProductPackagingUnitWidget/components/molecules/packaging-unit-quantity-selector/packaging-unit-quantity-selector';

const HIDDEN_CLASS_NAME = 'is-hidden';

export default class PackagingUnitQuantitySelector extends PackagingUnitQuantitySelectorCore {
    // protected eventInput: Event = new Event('input');
    //
    // protected initFormDefaultValues(): void {
    //     super.initFormDefaultValues();
    //
    //     this.triggerInputEvent(this.qtyInSalesUnitInput);
    // }
    //
    // protected onMeasurementUnitInputChange(event: Event): void {
    //     const salesUnitId = parseInt((<HTMLSelectElement>event.currentTarget).value);
    //     const salesUnit = this.getSalesUnitById(salesUnitId);
    //     let qtyInSalesUnits = this.formattedQtyInSalesUnitInput.unformattedValue;
    //     const qtyInBaseUnits = this.multiply(qtyInSalesUnits, this.currentSalesUnit.conversion);
    //     this.currentSalesUnit = salesUnit;
    //     qtyInSalesUnits = this.convertBaseUnitsAmountToCurrentSalesUnitsAmount(qtyInBaseUnits);
    //
    //     if (isFinite(qtyInSalesUnits)) {
    //         this.qtyInSalesUnitInput.value = String(this.round(qtyInSalesUnits, this.decimals));
    //         this.triggerInputEvent(this.qtyInSalesUnitInput);
    //     }
    //
    //     this.qtyInputChange(qtyInSalesUnits);
    // }
    //
    // protected selectAmount(amountInBaseUnits: number, amountInSalesUnits: number): void {
    //     this.amountInSalesUnitInput.value = String(amountInSalesUnits);
    //     this.triggerInputEvent(this.amountInSalesUnitInput);
    //     this.amountInBaseUnitInput.value = String(amountInBaseUnits);
    //
    //     if (!this.muError && !this.isAddToCartDisabled) {
    //         this.addToCartButton.removeAttribute('disabled');
    //     }
    //
    //     this.puChoiceElement.classList.add(HIDDEN_CLASS_NAME);
    //     this.onAmountInputChange();
    // }
    //
    // protected onLeadSalesUnitSelectChange(event: Event): void {
    //     const salesUnitId = parseInt((<HTMLSelectElement>event.currentTarget).value);
    //     const salesUnit = this.getLeadSalesUnitById(salesUnitId);
    //     const amountInSalesUnits = this.getAmountConversion(
    //         this.formattedAmountInSalesUnitInput.unformattedValue,
    //         salesUnit.conversion,
    //     );
    //     const amountInSalesUnitsMin = this.getAmountConversion(
    //         Number(this.amountInSalesUnitInput.min),
    //         salesUnit.conversion,
    //     );
    //     const amountInSalesUnitsMax = this.getAmountConversion(
    //         Number(this.amountInSalesUnitInput.max),
    //         salesUnit.conversion,
    //     );
    //     const amountInSalesUnitsStep = this.getAmountConversion(
    //         Number(this.amountInSalesUnitInput.step),
    //         salesUnit.conversion,
    //     );
    //
    //     this.currentLeadSalesUnit = salesUnit;
    //     this.amountInSalesUnitInput.value = String(amountInSalesUnits);
    //     this.triggerInputEvent(this.amountInSalesUnitInput);
    //
    //     if (this.amountInSalesUnitInput.min) {
    //         this.amountInSalesUnitInput.min = String(amountInSalesUnitsMin);
    //     }
    //
    //     if (this.amountInSalesUnitInput.max) {
    //         this.amountInSalesUnitInput.max = String(amountInSalesUnitsMax);
    //     }
    //
    //     if (this.amountInSalesUnitInput.step) {
    //         this.amountInSalesUnitInput.step = String(amountInSalesUnitsStep);
    //     }
    //
    //     this.onAmountInputChange(amountInSalesUnits);
    // }

        return null;
    }

    private selectAmount(amountInBaseUnits: number, amountInSalesUnits: number) {
        this.amountInSalesUnitInput.value = amountInSalesUnits.toString();
        this.triggerInputEvent(this.amountInSalesUnitInput);
        this.amountInBaseUnitInput.value = amountInBaseUnits;
        if (!this.muError && !this.isAddToCartDisabled) {
            this.addToCartButton.removeAttribute('disabled');
        }
        this.puChoiceElement.classList.add('is-hidden');
        this.amountInputChange();
    }

    private leadSalesUnitSelectChange(event: Event) {
        const salesUnitId = parseInt((event.target as HTMLSelectElement).value);
        const salesUnit = this.getLeadSalesUnitById(salesUnitId);

        const amountInSalesUnits = this.getAmountConversion(
            this.formattedAmountInSalesUnitInput.unformattedValue,
            salesUnit.conversion,
        );
        const amountInSalesUnitsMin = this.getAmountConversion(this.amountInSalesUnitInput.min, salesUnit.conversion);
        const amountInSalesUnitsMax = this.getAmountConversion(this.amountInSalesUnitInput.max, salesUnit.conversion);
        const amountInSalesUnitsStep = this.getAmountConversion(this.amountInSalesUnitInput.step, salesUnit.conversion);

        this.currentLeadSalesUnit = salesUnit;
        this.amountInSalesUnitInput.value = amountInSalesUnits;
        this.triggerInputEvent(this.amountInSalesUnitInput);

        if (this.amountInSalesUnitInput.min) {
            this.amountInSalesUnitInput.min = amountInSalesUnitsMin;
        }

        if (this.amountInSalesUnitInput.max) {
            this.amountInSalesUnitInput.max = amountInSalesUnitsMax;
        }

        if (this.amountInSalesUnitInput.step) {
            this.amountInSalesUnitInput.step = amountInSalesUnitsStep;
        }

        this.amountInputChange(amountInSalesUnits);
    }

    private hidePackagingUnitRestrictionNotifications() {
        this.puChoiceElement.classList.add('is-hidden');
        this.puMinNotificationElement.classList.add('is-hidden');
        this.puMaxNotificationElement.classList.add('is-hidden');
        this.puIntervalNotificationElement.classList.add('is-hidden');
    }

    private getLeadSalesUnitById(salesUnitId: number) {
        for (let key in this.leadSalesUnits) {
            if (this.leadSalesUnits.hasOwnProperty(key)) {
                if (salesUnitId == this.leadSalesUnits[key].id_product_measurement_sales_unit) {
                    return this.leadSalesUnits[key];
                }
            }
        }
    }

    private getMinAmount() {
        if (
            typeof this.productPackagingUnitStorage !== 'undefined' &&
            this.productPackagingUnitStorage.hasOwnProperty('amount_min') &&
            this.productPackagingUnitStorage.amount_min !== null
        ) {
            return Number(this.productPackagingUnitStorage.amount_min);
        }

        return 1;
    }

    private getMaxAmount() {
        if (
            typeof this.productPackagingUnitStorage !== 'undefined' &&
            this.productPackagingUnitStorage.hasOwnProperty('amount_max') &&
            this.productPackagingUnitStorage.amount_max !== null
        ) {
            return Number(this.productPackagingUnitStorage.amount_max);
        }

        return 0;
    }

    private getAmountInterval() {
        if (
            typeof this.productPackagingUnitStorage !== 'undefined' &&
            this.productPackagingUnitStorage.hasOwnProperty('amount_interval') &&
            this.productPackagingUnitStorage.amount_interval !== null
        ) {
            return Number(this.productPackagingUnitStorage.amount_interval);
        }

        return 1;
    }

    private getMinAmountChoice(amountInSalesUnits: number) {
        const amountInBaseUnits = Number(
            (
                (amountInSalesUnits * this.precision * Number(this.currentLeadSalesUnit.conversion)) /
                this.precision
            ).toFixed(this.numberOfDecimalPlaces),
        );

        if (amountInBaseUnits < this.getMinAmount()) {
            return this.getMinAmount();
        }

        if (this.isAmountGreaterThanMaxAmount(amountInBaseUnits)) {
            return 0;
        }

        if (this.isAmountMultipleToInterval(amountInBaseUnits)) {
            return this.getMinAmountChoice(
                (amountInBaseUnits - this.getAmountPercentageOfDivision(amountInBaseUnits)) /
                    this.currentLeadSalesUnit.conversion,
            );
        }

        return amountInBaseUnits;
    }

    private getMaxAmountChoice(amountInSalesUnits: number, minChoice: number) {
        let amountInBaseUnits = Number(
            (
                (amountInSalesUnits * this.precision * Number(this.currentLeadSalesUnit.conversion)) /
                this.precision
            ).toFixed(this.numberOfDecimalPlaces),
        );

        if (this.isAmountGreaterThanMaxAmount(amountInBaseUnits)) {
            amountInBaseUnits = this.getMaxAmount();

            if (this.isAmountMultipleToInterval(amountInBaseUnits)) {
                amountInBaseUnits = amountInBaseUnits - this.getAmountPercentageOfDivision(amountInBaseUnits);
            }

            return amountInBaseUnits;
        }

        if (amountInBaseUnits <= minChoice) {
            return 0;
        }

        if (this.isAmountMultipleToInterval(amountInBaseUnits)) {
            const nextPossibleInterval = Number(
                ((minChoice * this.precision + this.getAmountInterval() * this.precision) / this.precision).toFixed(
                    this.numberOfDecimalPlaces,
                ),
            );

            return nextPossibleInterval;
        }

        return amountInBaseUnits;
    }

    private isAmountGreaterThanMaxAmount(amountInBaseUnits: number) {
        return this.getMaxAmount() > 0 && amountInBaseUnits > this.getMaxAmount();
    }

    private isAmountMultipleToInterval(amountInBaseUnits: number) {
        return this.getAmountPercentageOfDivision(amountInBaseUnits) !== 0;
    }

    protected getAmountConversion(value: number, conversion: number): number {
        return parseFloat(
            ((value * this.precision * this.currentLeadSalesUnit.conversion) / conversion / this.precision).toFixed(
                this.numberOfDecimalPlaces,
            ),
        );
    }

    protected getAmountPercentageOfDivision(amountInBaseUnits: number): number {
        const amountMultiplyToPrecision = Math.round(amountInBaseUnits * this.precision);
        const minAmountMultiplyToPrecision = Math.round(this.getMinAmount() * this.precision);
        const amountIntervalMultiplyToPrecision = this.getAmountInterval() * this.precision;
        const currentMinusMinimumAmount = Number(
            ((amountMultiplyToPrecision - minAmountMultiplyToPrecision) / this.precision).toFixed(
                this.numberOfDecimalPlaces,
            ),
        );
        const currentMinusMinimumAmountMultiplyToPrecision = Math.round(currentMinusMinimumAmount * this.precision);
        const amountPercentageOfDivision = (
            (currentMinusMinimumAmountMultiplyToPrecision % amountIntervalMultiplyToPrecision) /
            this.precision
        ).toFixed(this.numberOfDecimalPlaces);

        return Number(amountPercentageOfDivision);
    }

    protected triggerInputEvent(input: HTMLInputElement): void {
        input.dispatchEvent(this.eventInput);
    }

    protected get precision(): number {
        return Number(`1${'0'.repeat(this.numberOfDecimalPlaces)}`);
    }
}
