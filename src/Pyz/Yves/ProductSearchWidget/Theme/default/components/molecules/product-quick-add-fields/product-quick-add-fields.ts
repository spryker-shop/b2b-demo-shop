import ProductQuickAddFieldsParentClass from 'ProductSearchWidget/components/molecules/product-quick-add-fields/product-quick-add-fields';
import AutocompleteForm from 'ShopUi/components/molecules/autocomplete-form/autocomplete-form';
import AjaxProvider from 'ShopUi/components/molecules/ajax-provider/ajax-provider';

export default class ProductQuickAddFields extends ProductQuickAddFieldsParentClass {
    protected readyCallback(): void {}

    mountCallback(): void {
        this.ajaxProvider = <AjaxProvider>this.querySelector(`.${this.jsName}__provider`);
        this.autocompleteInput = <AutocompleteForm>this.querySelector(this.autocompleteFormSelector);

        super.registerQuantityInput();
        super.mapEvents();
    }

    get autocompleteFormSelector(): string {
        return this.getAttribute('autocomplete-form-selector');
    }
}
