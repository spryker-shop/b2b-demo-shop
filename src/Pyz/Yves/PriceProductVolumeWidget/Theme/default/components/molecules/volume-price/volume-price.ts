import Component from 'ShopUi/models/component';

export default class VolumePrice extends Component {
    productPriceElement: HTMLElement;
    volumePricesData: Object[];
    quantityElement: HTMLFormElement;
    highLightedClass: string;
    currentQuantityValue: Number;

    protected readyCallback(): void {
        this.productPriceElement = <HTMLElement>this.querySelector(`.${this.jsName}__price`);
        this.volumePricesData = <Object[]>JSON.parse(this.dataset.json).reverse();
        this.quantityElement = <HTMLFormElement>document.querySelector(`.${this.jsName}__quantity`);
        this.highLightedClass = <string>`${this.name}__price--highlighted`;

        this.mapEvents();
    }

    private mapEvents(): void {
        this.quantityElement.addEventListener('change', this.quantityChangeHandler.bind(this));
        this.quantityElement.addEventListener('quantityChange', this.quantityChangeHandler.bind(this));
    }

    private quantityChangeHandler(event): void {
        this.currentQuantityValue = <Number> Number(event.target.value);
        this.checkQuantityValue();
    }

    private checkQuantityValue(): void {
        this.volumePricesData.every(this.checkQuantityValueCallback.bind(this))
    }

    private checkQuantityValueCallback(priceData) {
        const volumePrice: String = priceData.price;
        const volumePriceCount: Number = priceData.count;

        if(this.currentQuantityValue >= volumePriceCount) {
            this.changePrice(volumePrice);
            return false;
        }

        return true;
    }

    private changePrice(price): void {
        if(this.productPriceElement.innerText !== price) {
            this.productPriceElement.innerHTML = price;
            this.highlight();
        }
    }

    private highlight(): void {
        const classList = this.productPriceElement.classList;

        classList.remove(this.highLightedClass);
        this.productPriceElement.offsetWidth;
        classList.add(this.highLightedClass);
    }
}
