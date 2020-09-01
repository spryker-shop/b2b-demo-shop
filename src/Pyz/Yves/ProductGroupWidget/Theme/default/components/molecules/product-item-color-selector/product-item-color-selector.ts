import ProductItemColorSelectorCore from 'ProductGroupWidget/components/molecules/product-item-color-selector/product-item-color-selector';
import ProductItem, { ProductItemData } from 'src/ShopUi/components/molecules/product-item/product-item';

export default class ProductItemColorSelector extends ProductItemColorSelectorCore {
    protected productItemData: ProductItemData;
    protected productItem: ProductItem;

    protected getProductItemData(): void {
        super.getProductItemData();
        this.productItemData.reviewCount = this.reviewCount;
    }

    protected get reviewCount(): number {
        return Number(this.currentSelection.getAttribute('data-product-review-count'));
    }
}
