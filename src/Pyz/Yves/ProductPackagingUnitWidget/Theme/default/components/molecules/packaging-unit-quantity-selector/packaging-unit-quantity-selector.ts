import PackagingUnitQuantitySelectorCore from 'ProductPackagingUnitWidget/components/molecules/packaging-unit-quantity-selector/packaging-unit-quantity-selector';

export default class PackagingUnitQuantitySelector extends PackagingUnitQuantitySelectorCore {
    protected multiply(a: number, b: number): number {
        const result = a * b;
        const precision = 1000;

        return Math.round(result * precision) / precision;
    }
}
