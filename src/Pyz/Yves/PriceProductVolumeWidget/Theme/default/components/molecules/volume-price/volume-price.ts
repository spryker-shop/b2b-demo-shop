import Component from 'ShopUi/models/component';

interface VolumePricesData {
    price: string;
    count: number;
}

export default class VolumePrice extends Component {
    protected productPriceElement: HTMLElement;
    protected volumePricesData: VolumePricesData[];
    protected quantityElement: HTMLFormElement;
    protected highLightedClass: string;
    protected currentQuantityValue: number;
    protected timeout = 400;

    protected readyCallback(): void {}

    protected init(): void {
        this.productPriceElement = <HTMLElement>this.getElementsByClassName(`${this.jsName}__price`)[0];
        this.volumePricesData = <VolumePricesData[]>JSON.parse(this.dataset.json).reverse();
        this.quantityElement = <HTMLFormElement>document.getElementsByClassName(`${this.jsName}__quantity`)[0];
        this.highLightedClass = <string>`${this.name}__price--highlighted`;

        if (this.quantityElement) {
            this.mapEvents();
        }
    }

    private mapEvents(): void {
        this.quantityElement.addEventListener('change', this.quantityChangeHandler.bind(this));
        this.quantityElement.addEventListener('quantityChange', this.quantityChangeHandler.bind(this));
    }

    private quantityChangeHandler(event: Event): void {
        this.currentQuantityValue = Number((<HTMLInputElement>event.target).value);
        this.checkQuantityValue();
    }

    private checkQuantityValue(): void {
        this.volumePricesData.every(this.checkQuantityValueCallback.bind(this));
    }

    private checkQuantityValueCallback(priceData: VolumePricesData) {
        const volumePrice: string = priceData.price;
        const volumePriceCount: number = priceData.count;

        if (this.currentQuantityValue >= volumePriceCount) {
            this.changePrice(volumePrice);

            return false;
        }

        return true;
    }

    private changePrice(price: string): void {
        if (this.productPriceElement.innerText.trim() !== price.trim()) {
            this.productPriceElement.innerHTML = price;
            this.highlight();
        }
    }

    private highlight(): void {
        const classList = this.productPriceElement.classList;

        classList.add(this.highLightedClass);
        setTimeout(() => classList.remove(this.highLightedClass), this.timeout);
    }
}
