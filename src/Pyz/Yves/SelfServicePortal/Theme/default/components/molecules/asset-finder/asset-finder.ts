import Component from 'ShopUi/models/component';
import AjaxProvider from 'ShopUi/components/molecules/ajax-provider/ajax-provider';
import { AssetEventDetail, EVENT_SELECT_ASSET } from '../asset-list/asset-list';
import debounce from 'lodash-es/debounce';

export default class AssetFinder extends Component {
    protected searchInput: HTMLInputElement;
    protected hiddenInput: HTMLInputElement;
    protected selectedAssetText: HTMLElement;
    protected changeButton: HTMLButtonElement;
    protected ajaxProvider: AjaxProvider;
    protected currentSearchValue: string = '';
    protected resultsContainer: HTMLElement;

    protected readyCallback(): void {}
    protected init(): void {
        this.searchInput = <HTMLInputElement>this.querySelector(`.${this.jsName}__search-field`);
        this.hiddenInput = <HTMLInputElement>this.querySelector(`.${this.jsName}__value`);
        this.selectedAssetText = <HTMLElement>this.querySelector(`.${this.jsName}__selected-text`);
        this.changeButton = <HTMLButtonElement>this.querySelector(`.${this.jsName}__change-button`);
        this.ajaxProvider = <AjaxProvider>this.querySelector(`.${this.jsName}__ajax-provider`);
        this.resultsContainer = <HTMLElement>this.querySelector(`.${this.jsName}__results-container`);

        this.mapEvents();
    }

    protected mapEvents(): void {
        this.mapSearchInputEvents();
        this.mapDocumentClickEvent();
        this.mapSelectEvent();
        this.mapChangeButtonClickEvent();
    }

    protected mapSearchInputEvents(): void {
        this.searchInput.addEventListener(
            'keyup',
            debounce(() => this.onInputKeyUp(), this.debounceDelay),
        );
        this.searchInput.addEventListener('focus', () => this.onSearchFocus());
    }

    protected mapDocumentClickEvent(): void {
        document.addEventListener('click', (event: Event) => this.onDocumentClick(event));
    }

    protected mapSelectEvent(): void {
        this.addEventListener(EVENT_SELECT_ASSET, (event: CustomEvent) => this.selectAsset(event.detail));
    }

    protected mapChangeButtonClickEvent(): void {
        this.changeButton.addEventListener('click', () => this.onChangeButtonClick());
    }

    protected async onInputKeyUp(): Promise<void> {
        const value = this.searchInput.value.trim();
        const isSearchLengthValid = value.length >= this.minLetters || value.length === 0;

        if (isSearchLengthValid && value !== this.currentSearchValue) {
            this.currentSearchValue = value;
            await this.ajaxProvider.fetch();
        }
    }

    protected async onSearchFocus(): Promise<void> {
        await this.ajaxProvider.fetch();
        this.showResults();
    }

    protected selectAsset(data: AssetEventDetail): void {
        this.hiddenInput.value = data.reference;
        this.selectedAssetText.textContent = data.serial ? `${data.name}, ${data.serial}` : data.name;
        this.hideResults();
        this.classList.add(this.selectedClass);
        this.searchInput.value = '';
        this.currentSearchValue = '';
    }

    protected dispatchSelectAssetEvent(eventDetail: AssetEventDetail): void {
        this.dispatchCustomEvent(EVENT_SELECT_ASSET, eventDetail);
    }

    protected async onChangeButtonClick(): Promise<void> {
        this.hiddenInput.value = '';
        this.classList.remove(this.selectedClass);
        this.searchInput.focus();
    }

    protected onDocumentClick(): void {
        this.hideResults();
    }

    protected hideResults(): void {
        this.resultsContainer.classList.add(this.hiddenClass);
    }

    protected showResults(): void {
        this.resultsContainer.classList.remove(this.hiddenClass);
    }

    protected get debounceDelay(): number {
        return Number(this.getAttribute('debounce-delay'));
    }

    protected get minLetters(): number {
        return Number(this.getAttribute('min-letters'));
    }

    protected get hiddenClass(): string {
        return this.getAttribute('hidden-class');
    }

    protected get selectedClass(): string {
        return this.getAttribute('selected-class');
    }
}
