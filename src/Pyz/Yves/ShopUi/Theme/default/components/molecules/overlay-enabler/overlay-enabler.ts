import Component from 'ShopUi/models/component';
import OverlayBlock from '../../atoms/overlay-block/overlay-block';

export default class OverlayEnabler extends Component {
    protected modifiers: string[];
    protected triggers: HTMLElement[];
    protected overlay: OverlayBlock;
    protected overlayIsShown: boolean;

    protected readyCallback(): void {}

    protected init(): void {
        this.triggers = <HTMLElement[]>Array.from(document.getElementsByClassName(this.triggerClassName));
        this.modifiers = this.overlayModifiers.split(', ');
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
            this.hideOverlay();
        });
    }

    protected toggleOverlay(): void {
        this.overlayIsShown = !this.overlayIsShown;

        if (this.overlayIsShown) {
            this.showOverlay();

            return;
        }

        this.hideOverlay();
    }

    protected showOverlay(): void {
        if (this.modifiers.length) {
            this.overlay.showOverlay(this.modifiers[0], this.modifiers[1]);
        }
    }

    protected hideOverlay(): void {
        if (this.modifiers.length) {
            this.overlay.hideOverlay(this.modifiers[0], this.modifiers[1]);
        }
    }

    protected get triggerClassName(): string {
        return this.getAttribute('trigger-class-name');
    }

    protected get overlayModifiers(): string {
        return this.getAttribute('toggle-overlay-modifiers');
    }

    protected get overlayClassName(): string {
        return 'js-overlay-block';
    }
}
