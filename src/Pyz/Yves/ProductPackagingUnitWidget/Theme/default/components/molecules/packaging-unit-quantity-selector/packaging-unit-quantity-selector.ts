import PackagingUnitQuantitySelectorCore from 'ProductPackagingUnitWidget/components/molecules/packaging-unit-quantity-selector/packaging-unit-quantity-selector';

export default class PackagingUnitQuantitySelector extends PackagingUnitQuantitySelectorCore {
    protected multiply(a: number, b: number): number {
        const result = a * b;

        return Math.round(result * 1000) / 1000;
    }
}
