/* tslint:disable */
import Component from 'ShopUi/models/component';
import { mount } from 'ShopUi/app';
import FormattedNumberInput from 'ShopUi/components/molecules/formatted-number-input/formatted-number-input';

export default class PackagingUnitQuantitySelector extends Component {
    qtyInSalesUnitInput: HTMLInputElement;
    qtyInBaseUnitInput: HTMLInputElement;
    measurementUnitInput: HTMLSelectElement;
    addToCartButton: HTMLButtonElement;
    leadSalesUnitSelect: HTMLSelectElement;

    baseUnit: any;
    salesUnits: any;
    currentSalesUnit: any;
    productQuantityStorage: any;
    currentValue: Number;
    translations: any;
    leadSalesUnits: any;
    productPackagingUnitStorage: any;
    amountInSalesUnitInput: any;
    amountDefaultInBaseUnitInput: any;
    packagingUnitAmountInput: any;
    itemBasePriceInput: any;
    itemMoneySymbolInput: any;
    amountInBaseUnitInput: any;
    isAddToCartDisabled: boolean;
    currentLeadSalesUnit: any;
    defaultAmount: any;

    productPackagingNewPriceBlock: any;
    productPackagingNewPriceValueBlock: any;

    quantityBetweenElement: HTMLDivElement;
    quantityMinElement: HTMLDivElement;
    quantityMaxElement: HTMLDivElement;

    muChoiceNotificationElement: HTMLDivElement;
    muBetweenNotificationElement: HTMLDivElement;
    muMinNotificationElement: HTMLDivElement;
    muMaxNotificationElement: HTMLDivElement;
    muTranslationsElement: HTMLScriptElement;
    muChoiceListElement: HTMLUListElement;
    muCurrentChoiceElement: HTMLSpanElement;

    puChoiceElement: HTMLDivElement;
    puMinNotificationElement: HTMLDivElement;
    puMaxNotificationElement: HTMLDivElement;
    puIntervalNotificationElement: HTMLDivElement;
    puChoiceListElement: HTMLUListElement;
    puCurrentChoiceElement: HTMLSpanElement;

    muError: boolean;
    puError: boolean;
    protected numberOfDecimalPlaces: number = 10;
    protected eventInput: Event = new Event('input');
    protected formattedQtyInSalesUnitInput: FormattedNumberInput;
    protected formattedAmountInSalesUnitInput: FormattedNumberInput;

    protected readyCallback(): void {}

    protected async init(): Promise<void> {
        this.formattedQtyInSalesUnitInput = <FormattedNumberInput>(
            document.getElementsByClassName('js-formatted-sales-unit-quantity')[0]
        );
        
        this.qtyInSalesUnitInput = <HTMLInputElement>document.getElementById('sales-unit-quantity');
        this.qtyInBaseUnitInput = <HTMLInputElement>document.getElementById('base-unit-quantity');
        this.measurementUnitInput = <HTMLSelectElement>document.getElementsByClassName('select-measurement-unit')[0];
        this.addToCartButton = <HTMLButtonElement>document.getElementById('add-to-cart-button');
        this.leadSalesUnitSelect = <HTMLSelectElement>(
            document.getElementsByClassName('select-lead-measurement-unit')[0]
        );
        this.formattedAmountInSalesUnitInput = <FormattedNumberInput>(
            document.getElementsByClassName('js-formatted-user-amount')[0]
        );
        
        this.amountInSalesUnitInput = <HTMLInputElement>document.getElementById('user-amount');
        this.amountDefaultInBaseUnitInput = <HTMLInputElement>document.getElementById('default-amount');
        this.amountInBaseUnitInput = <HTMLInputElement>document.getElementById('amount');
        this.packagingUnitAmountInput = <HTMLInputElement>document.getElementsByClassName('select-measurement-unit')[0];
        this.productPackagingNewPriceBlock = <HTMLInputElement>(
            document.getElementById('product-packaging-new-price-block')
        );
        this.productPackagingNewPriceValueBlock = <HTMLInputElement>(
            document.getElementById('product-packaging-new-price-value-block')
        );
        this.itemBasePriceInput = <HTMLInputElement>document.getElementById('item-base-price');
        this.itemMoneySymbolInput = <HTMLInputElement>document.getElementById('item-money-symbol');
        this.quantityBetweenElement = <HTMLDivElement>document.getElementById('quantity-between-units');
        this.quantityMinElement = <HTMLDivElement>document.getElementById('minimum-quantity');
        this.quantityMaxElement = <HTMLDivElement>document.getElementById('maximum-quantity');
        this.muChoiceNotificationElement = <HTMLDivElement>(
            document.getElementsByClassName('measurement-unit-choice')[0]
        );
        this.muBetweenNotificationElement = <HTMLDivElement>document.getElementById('quantity-between-units');
        this.muMinNotificationElement = <HTMLDivElement>document.getElementById('minimum-quantity');
        this.muMaxNotificationElement = <HTMLDivElement>document.getElementById('maximum-quantity');
        this.muTranslationsElement = <HTMLScriptElement>document.getElementById('measurement-unit-translation');
        this.muChoiceListElement = <HTMLUListElement>(
            document.getElementById('measurement-unit-choices').getElementsByClassName('list')[0]
        );
        this.muCurrentChoiceElement = <HTMLSpanElement>(
            document.querySelector('.measurement-unit-choice #current-choice')
        );
        this.puChoiceElement = <HTMLDivElement>document.getElementsByClassName('packaging-unit-choice')[0];
        this.puMinNotificationElement = <HTMLDivElement>document.getElementById('packaging-amount-min');
        this.puMaxNotificationElement = <HTMLDivElement>document.getElementById('packaging-amount-max');
        this.puIntervalNotificationElement = <HTMLDivElement>document.getElementById('packaging-amount-interval');
        this.puChoiceListElement = <HTMLUListElement>(
            document.getElementById('packaging-unit-choices').getElementsByClassName('list')[0]
        );
        this.puCurrentChoiceElement = <HTMLSpanElement>(
            document.querySelector('.packaging-unit-choice #amount-current-choice')
        );
        this.puError = false;
        this.muError = false;

        this.initJson();
        this.initTranslations();
        this.initCurrentSalesUnit();
        this.initCurrentLeadSalesUnit();
        this.mapEvents();
        await mount();
        this.initFormDefaultValues();
        if (this.amountInBaseUnitInput) {
            this.amountInputChange();
        }
    }

    private initJson() {
        if (this.hasAttribute('json')) {
            let jsonString = this.getAttribute('json');
            let jsonData = JSON.parse(jsonString);

            if (jsonData.hasOwnProperty('baseUnit')) {
                this.baseUnit = jsonData.baseUnit;
            }

            if (jsonData.hasOwnProperty('salesUnits')) {
                this.salesUnits = jsonData.salesUnits;
            }

            if (jsonData.hasOwnProperty('leadSalesUnits')) {
                this.leadSalesUnits = jsonData.leadSalesUnits;
            }

            if (jsonData.hasOwnProperty('isAddToCartDisabled')) {
                this.isAddToCartDisabled = jsonData.isAddToCartDisabled;
            }

            if (jsonData.hasOwnProperty('productPackagingUnitStorage')) {
                this.productPackagingUnitStorage = jsonData.productPackagingUnitStorage;
            }

            if (jsonData.hasOwnProperty('productQuantityStorage')) {
                this.productQuantityStorage = jsonData.productQuantityStorage;
            }
        }
    }

    private initFormDefaultValues(): void {
        if (!this.amountInBaseUnitInput) {
            return;
        }

        this.qtyInSalesUnitInput.value = this.getMinQuantity().toString();
        this.triggerInputEvent(this.qtyInSalesUnitInput);

        if (this.leadSalesUnitSelect) {
            this.leadSalesUnitSelect.value = this.currentLeadSalesUnit.id_product_measurement_sales_unit;
        }

        if (this.measurementUnitInput) {
            this.measurementUnitInput.value = this.currentSalesUnit.id_product_measurement_sales_unit;
        }
    }

    private initTranslations() {
        this.translations = JSON.parse(this.muTranslationsElement.innerHTML);
    }

    private initCurrentSalesUnit() {
        for (let key in this.salesUnits) {
            if (this.salesUnits.hasOwnProperty(key)) {
                if (this.salesUnits[key].is_default) {
                    this.currentSalesUnit = this.salesUnits[key];
                }
            }
        }
    }

    private mapEvents() {
        this.qtyInSalesUnitInput.addEventListener('input', () => this.qtyInputChange());

        if (this.measurementUnitInput) {
            this.measurementUnitInput.addEventListener('change', (event: Event) =>
                this.measurementUnitInputChange(event),
            );
        }

        if (this.amountInSalesUnitInput) {
            this.amountInSalesUnitInput.addEventListener('input', () => this.amountInputChange());
        }

        if (this.leadSalesUnitSelect) {
            this.leadSalesUnitSelect.addEventListener('change', (event: Event) =>
                this.leadSalesUnitSelectChange(event),
            );
        }
    }

    private qtyInputChange(qtyInSalesUnits?: number) {
        if (typeof qtyInSalesUnits === 'undefined') {
            qtyInSalesUnits = this.formattedQtyInSalesUnitInput.unformattedValue;
        }

        this.muError = false;
        const qtyInBaseUnits = this.multiply(qtyInSalesUnits, Number(this.currentSalesUnit.conversion));

        if (qtyInBaseUnits < this.getMinQuantity()) {
            this.muError = true;
            this.hideNotifications();
            this.quantityMinElement.classList.remove('is-hidden');
        } else if ((qtyInBaseUnits - this.getMinQuantity()) % this.getQuantityInterval() !== 0) {
            this.muError = true;
            this.hideNotifications();
            this.quantityBetweenElement.classList.remove('is-hidden');
        } else if (this.getMaxQuantity() > 0 && qtyInBaseUnits > this.getMaxQuantity()) {
            this.muError = true;
            this.hideNotifications();
            this.quantityMaxElement.classList.remove('is-hidden');
        }

        if (this.muError && !isFinite(qtyInSalesUnits)) {
            this.addToCartButton.setAttribute('disabled', 'disabled');
            this.qtyInSalesUnitInput.setAttribute('disabled', 'disabled');

            return;
        }

        if (this.muError || this.puError || this.isAddToCartDisabled) {
            this.addToCartButton.setAttribute('disabled', 'disabled');
            this.askCustomerForCorrectInput(qtyInSalesUnits);

            return;
        }

        this.qtyInBaseUnitInput.value = qtyInBaseUnits.toString();

        if (this.amountInBaseUnitInput) {
            this.amountInputChange();
        }

        this.addToCartButton.removeAttribute('disabled');
        this.hideNotifications();

        return;
    }

    private hideNotifications() {
        this.muChoiceNotificationElement.classList.add('is-hidden');
        this.muBetweenNotificationElement.classList.add('is-hidden');
        this.muMinNotificationElement.classList.add('is-hidden');
        this.muMaxNotificationElement.classList.add('is-hidden');
    }

    private askCustomerForCorrectInput(qtyInSalesUnits: number) {
        if (this.muError) {
            let minChoice = this.getMinChoice(qtyInSalesUnits);
            let maxChoice = this.getMaxChoice(qtyInSalesUnits, minChoice);

            this.muChoiceListElement.innerHTML = '';
            this.muCurrentChoiceElement.innerHTML = '';
            this.muCurrentChoiceElement.textContent = `${this.round(qtyInSalesUnits, 4)} ${this.getUnitName(
                this.currentSalesUnit.product_measurement_unit.code,
            )}`;

            let choiceElements = [];
            choiceElements.push(this.createChoiceElement(minChoice));

            if (maxChoice != minChoice) {
                choiceElements.push(this.createChoiceElement(maxChoice));
            }

            choiceElements.forEach((element) =>
                element !== null ? this.muChoiceListElement.appendChild(element) : null,
            );

            this.muChoiceNotificationElement.classList.remove('is-hidden');
        }
    }

    private createChoiceElement(qtyInBaseUnits: number) {
        if (qtyInBaseUnits > 0) {
            let choiceElem = document.createElement('span');
            let qtyInSalesUnits = this.convertBaseUnitsAmountToCurrentSalesUnitsAmount(qtyInBaseUnits);
            let measurementSalesUnitName = this.getUnitName(this.currentSalesUnit.product_measurement_unit.code);
            let measurementBaseUnitName = this.getUnitName(this.baseUnit.code);

            choiceElem.classList.add('link');
            choiceElem.setAttribute('data-base-unit-qty', qtyInBaseUnits.toString());
            choiceElem.setAttribute('data-sales-unit-qty', qtyInSalesUnits.toString());
            choiceElem.textContent = `(${this.round(qtyInSalesUnits, 4)
                .toString()
                .toString()} ${measurementSalesUnitName}) = (${qtyInBaseUnits} ${measurementBaseUnitName})`;
            choiceElem.onclick = function (event: Event) {
                let element = event.target as HTMLSelectElement;
                let qtyInBaseUnits = parseFloat(element.dataset.baseUnitQty);
                let qtyInSalesUnits = parseFloat(element.dataset.salesUnitQty);
                this.muError = false;
                this.selectQty(qtyInBaseUnits, qtyInSalesUnits);
            }.bind(this);

            choiceElem.style.display = 'block';

            return choiceElem;
        }

        return null;
    }

    private selectQty(qtyInBaseUnits: number, qtyInSalesUnits: number) {
        this.qtyInBaseUnitInput.value = qtyInBaseUnits.toString();
        this.qtyInSalesUnitInput.value = this.round(qtyInSalesUnits, 4).toString().toString();
        this.triggerInputEvent(this.qtyInSalesUnitInput);
        if (!this.puError && !this.isAddToCartDisabled) {
            this.addToCartButton.removeAttribute('disabled');
            this.qtyInSalesUnitInput.removeAttribute('disabled');
        }
        this.muChoiceNotificationElement.classList.add('is-hidden');
        this.qtyInputChange();
    }

    private getMinChoice(qtyInSalesUnits: number) {
        let qtyInBaseUnits = this.floor(this.multiply(qtyInSalesUnits, this.currentSalesUnit.conversion));

        if (qtyInBaseUnits < this.getMinQuantity()) {
            return this.getMinQuantity();
        }

        if (
            (qtyInBaseUnits - this.getMinQuantity()) % this.getQuantityInterval() !== 0 ||
            (this.getMaxQuantity() > 0 && qtyInBaseUnits > this.getMaxQuantity())
        ) {
            return this.getMinChoice(this.convertBaseUnitsAmountToCurrentSalesUnitsAmount(qtyInBaseUnits - 1));
        }

        return qtyInBaseUnits;
    }

    private getMaxChoice(qtyInSalesUnits: number, minChoice: number) {
        let qtyInBaseUnits = this.ceil(this.multiply(qtyInSalesUnits, this.currentSalesUnit.conversion));

        if (this.getMaxQuantity() > 0 && qtyInBaseUnits > this.getMaxQuantity()) {
            qtyInBaseUnits = this.getMaxQuantity();

            if ((qtyInBaseUnits - this.getMinQuantity()) % this.getQuantityInterval() !== 0) {
                qtyInBaseUnits =
                    qtyInBaseUnits - ((qtyInBaseUnits - this.getMinQuantity()) % this.getQuantityInterval());
            }

            return qtyInBaseUnits;
        }

        if ((qtyInBaseUnits - this.getMinQuantity()) % this.getQuantityInterval() !== 0) {
            return this.getMaxChoice(
                this.convertBaseUnitsAmountToCurrentSalesUnitsAmount(
                    (qtyInBaseUnits + 1) / this.currentSalesUnit.conversion,
                ),
                minChoice,
            );
        }

        return qtyInBaseUnits;
    }

    protected convertBaseUnitsAmountToCurrentSalesUnitsAmount(qtyInBaseUnits: number): number {
        return (
            Math.round((qtyInBaseUnits / this.currentSalesUnit.conversion) * this.currentSalesUnit.precision) /
            this.currentSalesUnit.precision
        );
    }

    private floor(value: number): number {
        if (Math.floor(value) > 0) {
            return Math.floor(value);
        }

        return Math.ceil(value);
    }

    private ceil(value: number): number {
        return Math.ceil(value);
    }

    private round(value: number, decimals: number): number {
        return Number(Math.round(parseFloat(value + 'e' + decimals)) + 'e-' + decimals);
    }

    private multiply(a: number, b: number): number {
        const result = (a * 10 * (b * 10)) / 100;

        return Math.round(result * 1000) / 1000;
    }

    private getMinQuantity() {
        if (
            typeof this.productQuantityStorage !== 'undefined' &&
            this.productQuantityStorage.hasOwnProperty('quantity_min')
        ) {
            return this.productQuantityStorage.quantity_min;
        }

        return 1;
    }

    private getMaxQuantity() {
        if (
            typeof this.productQuantityStorage !== 'undefined' &&
            this.productQuantityStorage.hasOwnProperty('quantity_max') &&
            this.productQuantityStorage.quantity_max !== null
        ) {
            return this.productQuantityStorage.quantity_max;
        }

        return 0;
    }

    private getQuantityInterval() {
        if (
            typeof this.productQuantityStorage !== 'undefined' &&
            this.productQuantityStorage.hasOwnProperty('quantity_interval')
        ) {
            return this.productQuantityStorage.quantity_interval;
        }

        return 1;
    }

    private measurementUnitInputChange(event: Event) {
        let salesUnitId = parseInt((event.target as HTMLSelectElement).value);
        let salesUnit = this.getSalesUnitById(salesUnitId);
        let qtyInSalesUnits = this.formattedQtyInSalesUnitInput.unformattedValue;
        let qtyInBaseUnits = this.multiply(qtyInSalesUnits, this.currentSalesUnit.conversion);
        this.currentSalesUnit = salesUnit;
        qtyInSalesUnits = this.convertBaseUnitsAmountToCurrentSalesUnitsAmount(qtyInBaseUnits);

        if (isFinite(qtyInSalesUnits)) {
            this.qtyInSalesUnitInput.value = this.round(qtyInSalesUnits, 4).toString();
            this.triggerInputEvent(this.qtyInSalesUnitInput);
        }

        this.qtyInputChange(qtyInSalesUnits);
    }

    private getSalesUnitById(salesUnitId: number) {
        for (let key in this.salesUnits) {
            if (this.salesUnits.hasOwnProperty(key)) {
                if (salesUnitId == this.salesUnits[key].id_product_measurement_sales_unit) {
                    return this.salesUnits[key];
                }
            }
        }
    }

    private getUnitName(key) {
        if (this.translations.hasOwnProperty(key)) {
            return this.translations[key];
        }

        return key;
    }

    private amountInputChange(amountInSalesUnitInput?: number) {
        if (typeof amountInSalesUnitInput === 'undefined') {
            amountInSalesUnitInput = this.formattedAmountInSalesUnitInput.unformattedValue;
        }

        const amountInBaseUnits = Number(
            (
                (amountInSalesUnitInput * this.precision * Number(this.currentLeadSalesUnit.conversion)) /
                this.precision
            ).toFixed(this.numberOfDecimalPlaces),
        );

        this.productPackagingNewPriceBlock.classList.add('is-hidden');
        this.puError = false;

        if (!this.amountInSalesUnitInput.disabled) {
            if (this.isAmountMultipleToInterval(amountInBaseUnits)) {
                this.puError = true;
                this.puIntervalNotificationElement.classList.remove('is-hidden');
            }

            if (amountInBaseUnits < this.getMinAmount()) {
                this.puError = true;
                this.puMinNotificationElement.classList.remove('is-hidden');
            }

            if (this.getMaxAmount() > 0 && amountInBaseUnits > this.getMaxAmount()) {
                this.puError = true;
                this.puMaxNotificationElement.classList.remove('is-hidden');
            }
        }

        if (this.puError || this.muError || this.isAddToCartDisabled) {
            this.askCustomerForCorrectAmountInput(amountInSalesUnitInput);
            this.addToCartButton.setAttribute('disabled', 'disabled');

            return;
        }

        const quantity = Number(this.qtyInBaseUnitInput.value);
        const totalAmount = ((amountInBaseUnits * this.precision * quantity) / this.precision).toFixed(
            this.numberOfDecimalPlaces,
        );

        this.amountInBaseUnitInput.value = parseFloat(totalAmount);
        this.addToCartButton.removeAttribute('disabled');
        this.hidePackagingUnitRestrictionNotifications();

        this.priceCalculation(amountInBaseUnits);
    }

    protected priceCalculation(amountInBaseUnits: number): void {
        if (this.amountDefaultInBaseUnitInput.value != amountInBaseUnits) {
            let newPrice =
                (amountInBaseUnits / this.amountDefaultInBaseUnitInput.value) * this.itemBasePriceInput.value;
            newPrice = (newPrice * Number(this.qtyInBaseUnitInput.value)) / 100;
            this.productPackagingNewPriceValueBlock.innerHTML = this.itemMoneySymbolInput.value + newPrice.toFixed(2);

            this.productPackagingNewPriceBlock.classList.remove('is-hidden');
        }
    }

    private askCustomerForCorrectAmountInput(amountInSalesUnits) {
        if (this.puError) {
            let minChoice = this.getMinAmountChoice(amountInSalesUnits);
            let maxChoice = this.getMaxAmountChoice(amountInSalesUnits, minChoice);

            this.puChoiceListElement.innerHTML = '';
            this.puCurrentChoiceElement.innerHTML = '';
            this.puCurrentChoiceElement.textContent = `${this.round(amountInSalesUnits, 4)} ${this.getUnitName(
                this.currentLeadSalesUnit.product_measurement_unit.code,
            )}`;

            let choiceElements = [];

            if (minChoice) {
                choiceElements.push(this.createAmountChoiceElement(minChoice));
            }

            if (maxChoice != minChoice) {
                choiceElements.push(this.createAmountChoiceElement(maxChoice));
            }

            choiceElements.forEach((element) =>
                element !== null ? this.puChoiceListElement.appendChild(element) : null,
            );

            this.puChoiceElement.classList.remove('is-hidden');
        }
    }

    private initCurrentLeadSalesUnit() {
        for (let key in this.leadSalesUnits) {
            if (this.leadSalesUnits.hasOwnProperty(key)) {
                if (this.leadSalesUnits[key].is_default) {
                    this.currentLeadSalesUnit = this.leadSalesUnits[key];
                }
            }
        }
    }

    private createAmountChoiceElement(amountInBaseUnits: number) {
        if (amountInBaseUnits > 0) {
            const choiceElem = document.createElement('span');
            const amountInSalesUnits = (
                (amountInBaseUnits * this.precision) /
                this.currentLeadSalesUnit.conversion /
                this.precision
            ).toFixed(this.numberOfDecimalPlaces);
            const measurementSalesUnitName = this.getUnitName(this.currentLeadSalesUnit.product_measurement_unit.code);
            const measurementBaseUnitName = this.getUnitName(this.baseUnit.code);

            choiceElem.classList.add('link');
            choiceElem.setAttribute('data-base-unit-amount', amountInBaseUnits.toString());
            choiceElem.setAttribute('data-sales-unit-amount', parseFloat(amountInSalesUnits).toString());
            choiceElem.textContent = `(${parseFloat(
                amountInSalesUnits,
            )} ${measurementSalesUnitName}) = (${amountInBaseUnits} ${measurementBaseUnitName})`;
            choiceElem.onclick = function (event: Event) {
                let element = event.srcElement as HTMLSelectElement;
                let amountInBaseUnits = parseFloat(element.dataset.baseUnitAmount);
                let amountInSalesUnits = parseFloat(element.dataset.salesUnitAmount);
                this.puError = false;
                this.selectAmount(amountInBaseUnits, amountInSalesUnits);
            }.bind(this);

            choiceElem.style.display = 'block';

            return choiceElem;
        }

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

        const amountInSalesUnits = this.getAmountConversion(this.formattedAmountInSalesUnitInput.unformattedValue, salesUnit.conversion);
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
