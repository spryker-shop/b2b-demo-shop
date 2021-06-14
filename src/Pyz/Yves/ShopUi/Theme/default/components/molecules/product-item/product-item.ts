import ProductItemCore, {
    ProductItemData as ProductItemDataCore,
} from 'ShopUi/components/molecules/product-item/product-item';

export const EVENT_UPDATE_REVIEW_COUNT = 'updateReviewCount';

export interface ProductItemData extends ProductItemDataCore {
    reviewCount: number;
}

export default class ProductItem extends ProductItemCore {
    protected productReviewCount: HTMLElement;

    protected init(): void {
        this.productReviewCount = <HTMLElement>this.getElementsByClassName(`${this.jsName}__review-count`)[0];

        super.init();
    }

    set originalPrice(originalPrice: string) {
        if (this.productOriginalPrice) {
            this.productOriginalPrice.innerText = originalPrice;
        }

        this.setDefaultPriceColor(originalPrice);
    }

    protected setDefaultPriceColor(originalPrice: string): void {
        if (!this.productDefaultPrice) {
            return;
        }

        if (!originalPrice) {
            this.productDefaultPrice.classList.remove(this.defaultPriceColorClassName);

            return;
        }

        this.productDefaultPrice.classList.add(this.defaultPriceColorClassName);
    }

    updateProductItemData(data: ProductItemData): void {
        super.updateProductItemData(data);
        this.reviewCount = data.reviewCount;
    }

    protected set reviewCount(reviewCount: number) {
        this.dispatchCustomEvent(EVENT_UPDATE_REVIEW_COUNT, { reviewCount });
    }

    protected get defaultPriceColorClassName(): string {
        return this.getAttribute('default-price-color-class-name');
    }
}
