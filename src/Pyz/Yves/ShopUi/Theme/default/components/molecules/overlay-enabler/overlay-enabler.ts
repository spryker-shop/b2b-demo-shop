import Component from 'ShopUi/models/component';
import OverlayBlock from '../../atoms/overlay-block/overlay-block';

export default class OverlayEnabler extends Component {
    protected triggers: HTMLElement[];
    protected overlay: OverlayBlock;
    protected overlayIsShown: boolean;

    protected readyCallback(): void {}

    protected init(): void {
        this.triggers = <HTMLElement[]>Array.from(document.getElementsByClassName(this.triggerClassName));
        this.overlay = <OverlayBlock>document.getElementsByClassName(this.overlayClassName)[0];
        this.overlayIsShown = false;
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.triggers.forEach((trigger: HTMLElement) => {
            trigger.addEventListener('click', () => this.toggleOverlay());
        });

        this.overlay.addEventListener('click', () => {
            this.overlayIsShown = false;
            this.overlay.hideOverlay();
        });
    }

    protected toggleOverlay(): void {
        this.overlayIsShown = !this.overlayIsShown;

        if (this.overlayIsShown) {
            this.overlay.showOverlay();

            return;
        }

        this.overlay.hideOverlay();
    }

    protected get triggerClassName(): string {
        return this.getAttribute('trigger-class-name');
    }

    protected get overlayClassName(): string {
        return this.getAttribute('overlay-class-name');
    }
}
