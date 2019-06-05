import ProductQuickAddFieldsParentClass from 'ProductSearchWidget/components/molecules/product-quick-add-fields/product-quick-add-fields';
import AutocompleteForm from 'ShopUi/components/molecules/autocomplete-form/autocomplete-form';
import AjaxProvider from 'ShopUi/components/molecules/ajax-provider/ajax-provider';

export default class ProductQuickAddFields extends ProductQuickAddFieldsParentClass {
    protected readyCallback(): void {
        this.ajaxProvider = <AjaxProvider>this.querySelector(`.${this.jsName}__provider`);
        this.autocompleteInput = <AutocompleteForm>this.querySelector('product-search-autocomplete-form');

        super.registerQuantityInput();
        super.mapEvents();
    }
}
