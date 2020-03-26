import LabelGroupCore from 'ProductLabelWidget/components/molecules/label-group/label-group';
import { ProductItemLabelsData } from 'ShopUi/components/molecules/product-item/product-item';

export default class LabelGroup extends LabelGroupCore {
    setProductLabels(labels: ProductItemLabelsData[]) {
        if (!labels.length) {
            this.productLabelFlags.forEach((element: HTMLElement) => element.classList.add(this.classToToggle));

            return;
        }

        this.updateProductLabels(labels);
    }

    protected updateProductLabels(labelFlags: ProductItemLabelsData[]): void {
        labelFlags.forEach((element: ProductItemLabelsData, index: number) => {
            if (index) {
                this.createProductLabelFlagClones();
            }

            this.deleteProductLabelFlagClones(labelFlags);
            this.deleteProductLabelFlagModifiers(index);
            this.updateProductLabelFlags(element, index);
        });
    }
}
