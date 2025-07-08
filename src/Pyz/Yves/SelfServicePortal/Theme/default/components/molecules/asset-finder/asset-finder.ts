import { AssetEventDetail } from 'SelfServicePortal/components/molecules/asset-list/asset-list';
import CoreAssetFinder from 'SelfServicePortal/components/molecules/asset-finder/asset-finder';
import { EVENT_CLOSE_POPUP } from 'ShopUi/components/molecules/main-popup/main-popup';

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
    protected mapChangeButtonClickEvent(): void { }
    // eslint-disable-next-line @typescript-eslint/no-empty-function
    protected async onSearchFocus(): Promise<void> { }
}
