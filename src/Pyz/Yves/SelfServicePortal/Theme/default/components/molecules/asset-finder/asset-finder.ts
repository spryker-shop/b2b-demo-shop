import { AssetEventDetail } from 'SelfServicePortal/components/molecules/asset-list/asset-list';
import CoreAssetFinder from 'SelfServicePortal/components/molecules/asset-finder/asset-finder';
import { EVENT_CLOSE_POPUP } from 'ShopUi/components/molecules/main-popup/main-popup';
import debounce from 'lodash-es/debounce';

export default class AssetFinder extends CoreAssetFinder {
    protected popup: HTMLElement;
    protected container: HTMLElement;
    protected selectedName: HTMLElement;

    protected mapEvents(): void {
        this.hiddenInput = document.querySelector(`.${this.getAttribute('input-class-name')}`);
        this.selectedAssetText = document.querySelector(`.${this.getAttribute('selected-asset-class-name')}`);
        this.selectedName = document.querySelector(`.${this.getAttribute('selected-name-class-name')}`);
        this.popup = document.querySelector(`.${this.getAttribute('popup-class-name')}`);
        this.container = document.querySelector(`.${this.getAttribute('container-class-name')}`);
        this.clearElement = document.querySelector(`.${this.getAttribute('clear-class-name')}`);

        super.mapEvents();
    }

    protected selectAsset(data: AssetEventDetail): void {
        super.selectAsset(data);
        this.selectedName.textContent = data.name;
        this.selectedAssetText.textContent = data.serial || '';

        this.container.classList.add(this.selectedClass);
        this.popup.dispatchEvent(new CustomEvent(EVENT_CLOSE_POPUP));
    }

    // eslint-disable-next-line @typescript-eslint/no-empty-function
    protected mapChangeButtonClickEvent(): void {}

    protected mapSearchInputEvents(): void {
        this.searchInput.addEventListener(
            'keyup',
            debounce(() => this.onInputKeyUp(), this.debounceDelay),
        );
    }

    protected mapClearClickEvent(): void {
        this.clearElement?.addEventListener('click', (event) => this.clearStateEvent(event));
    }

    protected clearStateEvent(event?: Event): void {
        this.clearState(event);
        this.container.classList.remove(this.selectedClass);
    }
}
