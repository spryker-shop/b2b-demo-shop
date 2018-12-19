import Component from 'ShopUi/models/component';

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
    isAmountBlockEnabled: boolean;
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

    protected readyCallback(event?: Event): void {
        this.qtyInSalesUnitInput = <HTMLInputElement>document.querySelector('#sales-unit-quantity');
        this.qtyInBaseUnitInput = <HTMLInputElement>document.querySelector('#base-unit-quantity');
        this.measurementUnitInput = <HTMLSelectElement>document.querySelector('.select-measurement-unit');
        this.addToCartButton = <HTMLButtonElement>document.getElementById('add-to-cart-button');
        this.leadSalesUnitSelect = <HTMLSelectElement>document.querySelector('.select-lead-measurement-unit');
        this.amountInSalesUnitInput = <HTMLInputElement>document.querySelector('#user-amount');
        this.amountDefaultInBaseUnitInput = <HTMLInputElement>document.querySelector('#default-amount');
        this.amountInBaseUnitInput = <HTMLInputElement>document.querySelector('#amount');
        this.packagingUnitAmountInput = <HTMLInputElement>document.querySelector('#packaging-unit-amount');
        this.productPackagingNewPriceBlock = <HTMLInputElement>document.querySelector('#product-packaging-new-price-block');
        this.productPackagingNewPriceValueBlock = <HTMLInputElement>document.querySelector('#product-packaging-new-price-value-block');
        this.itemBasePriceInput = <HTMLInputElement>document.querySelector('#item-base-price');
        this.itemMoneySymbolInput = <HTMLInputElement>document.querySelector('#item-money-symbol');
        this.quantityBetweenElement = <HTMLDivElement>document.getElementById('quantity-between-units');
        this.quantityMinElement = <HTMLDivElement>document.getElementById('minimum-quantity');
        this.quantityMaxElement = <HTMLDivElement>document.getElementById('maximum-quantity');
        this.muChoiceNotificationElement = <HTMLDivElement>document.querySelector('.measurement-unit-choice');
        this.muBetweenNotificationElement = <HTMLDivElement>document.getElementById('quantity-between-units');
        this.muMinNotificationElement = <HTMLDivElement>document.getElementById('minimum-quantity');
        this.muMaxNotificationElement = <HTMLDivElement>document.getElementById('maximum-quantity');
        this.muTranslationsElement = <HTMLScriptElement>document.getElementById('measurement-unit-translation');
        this.muChoiceListElement = <HTMLUListElement>document.querySelector('#measurement-unit-choices .list');
        this.muCurrentChoiceElement = <HTMLSpanElement>document.querySelector('.measurement-unit-choice #current-choice');
        this.puChoiceElement = <HTMLDivElement>document.querySelector('.packaging-unit-choice');
        this.puMinNotificationElement = <HTMLDivElement>document.getElementById('packaging-amount-min');
        this.puMaxNotificationElement = <HTMLDivElement>document.getElementById('packaging-amount-max');
        this.puIntervalNotificationElement = <HTMLDivElement>document.getElementById('packaging-amount-interval');
        this.puChoiceListElement = <HTMLUListElement>document.querySelector('#packaging-unit-choices .list');
        this.puCurrentChoiceElement = <HTMLSpanElement>document.querySelector('.packaging-unit-choice #amount-current-choice');
        this.puError = false;
        this.muError = false;

        this.initJson();
        this.initTranslations();
        this.initCurrentSalesUnit();
        this.initCurrentLeadSalesUnit();
        this.initFormDefaultValues();
        this.mapEvents();
        if(this.amountInBaseUnitInput) {
            this.amountInputChange();
        }
    }

    private initJson() {
        let jsonSchemaContainer = document.getElementsByClassName(this.name + '__json')[0];
        if (jsonSchemaContainer.hasAttribute('json')) {
            let jsonString = jsonSchemaContainer.getAttribute('json');
            let jsonData = JSON.parse(jsonString);

            if (jsonData.hasOwnProperty('baseUnit')) {
                this.baseUnit = jsonData.baseUnit;
            }

            if (jsonData.hasOwnProperty('salesUnits')) {
                this.salesUnits = jsonData.salesUnits;
            }

            if(jsonData.hasOwnProperty('leadSalesUnits')) {
                this.leadSalesUnits = jsonData.leadSalesUnits;
            }

            if (jsonData.hasOwnProperty('isAmountBlockEnabled')) {
                this.isAmountBlockEnabled = jsonData.isAmountBlockEnabled;
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

    private initFormDefaultValues() {
        if(this.amountInBaseUnitInput) {
            this.qtyInSalesUnitInput.value = this.getMinQuantity().toString();
            this.amountInSalesUnitInput.value = this.getDefaultAmount();
            this.amountDefaultInBaseUnitInput.value = this.getDefaultAmount();
            this.amountInBaseUnitInput.value = this.getDefaultAmount();
            this.leadSalesUnitSelect.value = this.currentLeadSalesUnit.id_product_measurement_sales_unit;
            this.measurementUnitInput.value = this.currentSalesUnit.id_product_measurement_sales_unit;

        }
    }

    private initTranslations() {
        this.translations = JSON.parse(this.muTranslationsElement.innerHTML)
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
        this.qtyInSalesUnitInput.addEventListener('input', (event: Event) => this.qtyInputChange());
        this.qtyInSalesUnitInput.addEventListener('change', (event: Event) => this.qtyInputChange());
        this.measurementUnitInput.addEventListener('change', (event: Event) => this.measurementUnitInputChange(event));

        if(this.isAmountBlockEnabled) {
            this.amountInSalesUnitInput.addEventListener('change', (event: Event) => this.amountInputChange());
            this.leadSalesUnitSelect.addEventListener('change', (event: Event) => this.leadSalesUnitSelectChange(event));
        }
    }

    private qtyInputChange(qtyInSalesUnits?: number) {
        if (typeof qtyInSalesUnits === 'undefined') {
            qtyInSalesUnits = +this.qtyInSalesUnitInput.value;
        }

        this.muError = false;
        let qtyInBaseUnits = this.multiply(qtyInSalesUnits, +this.currentSalesUnit.conversion);

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

        if (this.muError || this.puError || this.isAddToCartDisabled) {
            this.addToCartButton.setAttribute("disabled", "disabled");
            this.askCustomerForCorrectInput(qtyInSalesUnits);
            return;
        }

        this.qtyInBaseUnitInput.value = qtyInBaseUnits.toString();

        if(this.amountInBaseUnitInput) {
            this.amountInputChange();
        }

        this.addToCartButton.removeAttribute("disabled");
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

        if(this.muError) {
            let minChoice = this.getMinChoice(qtyInSalesUnits);
            let maxChoice = this.getMaxChoice(qtyInSalesUnits, minChoice);

            this.muChoiceListElement.innerHTML = '';
            this.muCurrentChoiceElement.innerHTML = '';
            this.muCurrentChoiceElement.textContent = `${this.round(qtyInSalesUnits, 4)} ${this.getUnitName(this.currentSalesUnit.product_measurement_unit.code)}`;

            let choiceElements = [];
            choiceElements.push(this.createChoiceElement(minChoice));

            if (maxChoice != minChoice) {
                choiceElements.push(this.createChoiceElement(maxChoice));
            }

            choiceElements.forEach((element) => (element !== null) ? this.muChoiceListElement.appendChild(element) : null);

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
            choiceElem.textContent = `(${this.round(qtyInSalesUnits, 4).toString().toString()} ${measurementSalesUnitName}) = (${qtyInBaseUnits} ${measurementBaseUnitName})`;
            choiceElem.onclick = function (event: Event) {
                let element = event.srcElement as HTMLSelectElement;
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
        if (!this.puError && !this.isAddToCartDisabled) {
            this.addToCartButton.removeAttribute("disabled");
        }
        this.muChoiceNotificationElement.classList.add('is-hidden');
    }

    private getMinChoice(qtyInSalesUnits: number) {
        let qtyInBaseUnits = this.floor(this.multiply(qtyInSalesUnits, this.currentSalesUnit.conversion));

        if (qtyInBaseUnits < this.getMinQuantity()) {
            return this.getMinQuantity();
        }

        if ((qtyInBaseUnits - this.getMinQuantity()) % this.getQuantityInterval() !== 0 || (this.getMaxQuantity() > 0 && qtyInBaseUnits > this.getMaxQuantity())) {
             return this.getMinChoice(this.convertBaseUnitsAmountToCurrentSalesUnitsAmount(qtyInBaseUnits - 1));
        }

        return qtyInBaseUnits;
    }

    private convertBaseUnitsAmountToCurrentSalesUnitsAmount(qtyInBaseUnits: number)
    {
        return Math.round(qtyInBaseUnits / this.currentSalesUnit.conversion * this.currentSalesUnit.precision) / this.currentSalesUnit.precision;
    }

    private getMaxChoice(qtyInSalesUnits: number, minChoice: number) {
        let qtyInBaseUnits = this.ceil(this.multiply(qtyInSalesUnits, this.currentSalesUnit.conversion));

        if (this.getMaxQuantity() > 0 && qtyInBaseUnits > this.getMaxQuantity()) {
            qtyInBaseUnits = this.getMaxQuantity();

            if ((qtyInBaseUnits - this.getMinQuantity()) % this.getQuantityInterval() !== 0) {
                qtyInBaseUnits = qtyInBaseUnits - ((qtyInBaseUnits - this.getMinQuantity()) % this.getQuantityInterval());
            }

            return qtyInBaseUnits;
        }

        if ((qtyInBaseUnits - this.getMinQuantity()) % this.getQuantityInterval() !== 0 ) {
            return this.getMaxChoice(this.convertBaseUnitsAmountToCurrentSalesUnitsAmount((qtyInBaseUnits + 1) / this.currentSalesUnit.conversion), minChoice)
        }

        return qtyInBaseUnits;
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
        let result = ((a * 10) * (b * 10)) / 100;

        return Math.round(result * 1000) / 1000;
    }

    private getMinQuantity() {
        if (typeof this.productQuantityStorage !== 'undefined'
            && this.productQuantityStorage.hasOwnProperty('quantity_min')
        ) {
            return this.productQuantityStorage.quantity_min;
        }

        return 1;
    }

    private getMaxQuantity() {
        if (typeof this.productQuantityStorage !== 'undefined'
            && this.productQuantityStorage.hasOwnProperty('quantity_max')
            && this.productQuantityStorage.quantity_max !== null
        ) {
            return this.productQuantityStorage.quantity_max;
        }

        return 0;
    }

    private getQuantityInterval() {
        if (typeof this.productQuantityStorage !== 'undefined'
            && this.productQuantityStorage.hasOwnProperty('quantity_interval')
        ) {
            return this.productQuantityStorage.quantity_interval;
        }

        return 1;
    }

    private measurementUnitInputChange(event: Event) {
        let salesUnitId = parseInt((event.srcElement as HTMLSelectElement).value);
        let salesUnit = this.getSalesUnitById(salesUnitId);
        let qtyInSalesUnits = +this.qtyInSalesUnitInput.value;
        let qtyInBaseUnits = this.multiply(qtyInSalesUnits, this.currentSalesUnit.conversion);
        this.currentSalesUnit = salesUnit;
        qtyInSalesUnits = this.convertBaseUnitsAmountToCurrentSalesUnitsAmount(qtyInBaseUnits);
        this.qtyInSalesUnitInput.value = this.round(qtyInSalesUnits, 4).toString();
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
            amountInSalesUnitInput = +this.amountInSalesUnitInput.value;
        }
        this.productPackagingNewPriceBlock.classList.add('is-hidden');
        this.puError = false;
        let amountInBaseUnits = this.multiply(amountInSalesUnitInput, +this.currentLeadSalesUnit.conversion);
        amountInBaseUnits = Math.round(amountInBaseUnits);

        if ((amountInBaseUnits - this.getMinAmount()) % this.getAmountInterval() !== 0) {
            this.puError = true;
            this.puIntervalNotificationElement.classList.remove('is-hidden');
        } else if (amountInBaseUnits < this.getMinAmount()) {
            this.puError = true;
            this.puMinNotificationElement.classList.remove('is-hidden');
        } else if (this.getMaxAmount() > 0 && amountInBaseUnits > this.getMaxAmount()) {
            this.puError = true;
            this.puMaxNotificationElement.classList.remove('is-hidden');
        }

        if (this.puError || this.muError || this.isAddToCartDisabled) {
            this.askCustomerForCorrectAmountInput(amountInSalesUnitInput);
            this.addToCartButton.setAttribute("disabled", "disabled");

            return;
        }

        let quantity = +this.qtyInBaseUnitInput.value;
        let totalAmount = amountInBaseUnits * quantity;

        this.amountInBaseUnitInput.value = totalAmount.toString();
        this.addToCartButton.removeAttribute("disabled");
        this.hidePackagingUnitRestrictionNotifications();

        if (this.amountDefaultInBaseUnitInput.value != amountInBaseUnits) {
            let newPrice = (amountInBaseUnits / this.amountDefaultInBaseUnitInput.value) * this.itemBasePriceInput.value;
            newPrice = newPrice / 100;
            this.productPackagingNewPriceValueBlock.innerHTML = this.itemMoneySymbolInput.value + newPrice.toFixed(2);

            this.productPackagingNewPriceBlock.classList.remove('is-hidden');
        }

        return;
    }

    private askCustomerForCorrectAmountInput(amountInSalesUnits) {

        if(this.puError) {
            let minChoice = this.getMinAmountChoice(amountInSalesUnits);
            let maxChoice = this.getMaxAmountChoice(amountInSalesUnits, minChoice);

            this.puChoiceListElement.innerHTML = '';
            this.puCurrentChoiceElement.innerHTML = '';
            this.puCurrentChoiceElement.textContent = `${this.round(amountInSalesUnits, 4)} ${this.getUnitName(this.currentLeadSalesUnit.product_measurement_unit.code)}`;

            let choiceElements = [];

            if (minChoice) {
                choiceElements.push(this.createAmountChoiceElement(minChoice));
            }

            if (maxChoice != minChoice) {
                choiceElements.push(this.createAmountChoiceElement(maxChoice));
            }

            choiceElements.forEach((element) => (element !== null) ? this.puChoiceListElement.appendChild(element) : null);

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
            let choiceElem = document.createElement('span');
            let amountInSalesUnits = this.convertBaseUnitsAmountToCurrentSalesUnitsAmount(amountInBaseUnits);
            let measurementSalesUnitName = this.getUnitName(this.currentLeadSalesUnit.product_measurement_unit.code);
            let measurementBaseUnitName = this.getUnitName(this.baseUnit.code);

            choiceElem.classList.add('link');
            choiceElem.setAttribute('data-base-unit-amount', amountInBaseUnits.toString());
            choiceElem.setAttribute('data-sales-unit-amount', amountInSalesUnits.toString());
            choiceElem.textContent = `(${this.round(amountInSalesUnits, 4).toString().toString()} ${measurementSalesUnitName}) = (${amountInBaseUnits} ${measurementBaseUnitName})`;
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
        this.amountInBaseUnitInput.value = this.round(amountInBaseUnits, 4).toString().toString();
        if (!this.muError && !this.isAddToCartDisabled) {
            this.addToCartButton.removeAttribute("disabled");
        }
        this.puChoiceElement.classList.add('is-hidden');
        this.amountInputChange();
    }

    private leadSalesUnitSelectChange(event: Event) {
        let salesUnitId = parseInt((event.srcElement as HTMLSelectElement).value);
        let salesUnit = this.getLeadSalesUnitById(salesUnitId);
        let amountInSalesUnits = +this.amountInSalesUnitInput.value;
        let amountInBaseUnits = this.multiply(amountInSalesUnits, this.currentLeadSalesUnit.conversion);
        amountInSalesUnits = amountInBaseUnits / salesUnit.conversion;
        this.currentLeadSalesUnit = salesUnit;
        this.amountInSalesUnitInput.value = this.round(amountInSalesUnits, 4).toString();
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
        if (typeof this.productPackagingUnitStorage !== 'undefined'
            && this.productPackagingUnitStorage.hasOwnProperty('amount_min')
            && this.productPackagingUnitStorage.amount_min !== null
        ) {
            return this.productPackagingUnitStorage.amount_min;
        }

        return 1;
    }

    private getMaxAmount() {
        if (typeof this.productPackagingUnitStorage !== 'undefined'
            && this.productPackagingUnitStorage.hasOwnProperty('amount_max')
            && this.productPackagingUnitStorage.amount_max !== null
        ) {
            return this.productPackagingUnitStorage.amount_max;
        }

        return 0;
    }

    private getAmountInterval() {
        if (typeof this.productPackagingUnitStorage !== 'undefined'
            && this.productPackagingUnitStorage.hasOwnProperty('amount_interval')
            && this.productPackagingUnitStorage.amount_interval !== null
        ) {
            return this.productPackagingUnitStorage.amount_interval;
        }

        return 1;
    }

    private getDefaultAmount() {
        if (typeof this.productPackagingUnitStorage !== 'undefined'
            && this.productPackagingUnitStorage.hasOwnProperty('default_amount')
            && this.productPackagingUnitStorage.default_amount !== null
        ) {
            return this.productPackagingUnitStorage.default_amount;
        }
    }

    private getMinAmountChoice(amountInSalesUnits: number) {
        let amountInBaseUnits = this.floor(this.multiply(amountInSalesUnits, this.currentLeadSalesUnit.conversion));

        if (amountInBaseUnits < this.getMinAmount()) {
            return this.getMinAmount();
        }

        if(this.isAmountGreaterThanMaxAmount(amountInBaseUnits)) {
            return 0;
        }

        if (this.isAmountMultipleToInterval(amountInBaseUnits)) {
            return this.getMinAmountChoice((amountInBaseUnits - 1) / this.currentLeadSalesUnit.conversion);
        }

        return amountInBaseUnits;
    }

    private getMaxAmountChoice(amountInSalesUnits: number, minChoice: number) {
        let amountInBaseUnits = this.ceil(this.multiply(amountInSalesUnits, this.currentLeadSalesUnit.conversion));

        if (this.isAmountGreaterThanMaxAmount(amountInBaseUnits)) {
            amountInBaseUnits = this.getMaxAmount();

            if (this.isAmountMultipleToInterval(amountInBaseUnits)) {
                amountInBaseUnits = amountInBaseUnits - ((amountInBaseUnits - this.getMinAmount()) % this.getAmountInterval());
            }

            return amountInBaseUnits;
        }

        if (amountInBaseUnits <= minChoice) {
            return 0;
        }

        if (this.isAmountMultipleToInterval(amountInBaseUnits)) {
            return minChoice + this.getAmountInterval();
        }

        return amountInBaseUnits;
    }

    private isAmountGreaterThanMaxAmount(amountInBaseUnits: number) {
        return this.getMaxAmount() > 0 && amountInBaseUnits > this.getMaxAmount();
    }

    private isAmountMultipleToInterval(amountInBaseUnits: number) {
        return (amountInBaseUnits - this.getMinAmount()) % this.getAmountInterval() !== 0;
    }
}
