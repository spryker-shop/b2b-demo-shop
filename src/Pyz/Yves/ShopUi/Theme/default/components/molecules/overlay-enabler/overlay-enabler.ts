import OverlayBlock from '../../atoms/overlay-block/overlay-block';

export default class OverlayEnabler extends OverlayBlock {
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
            this.removeOverlay();
        });
    }

    protected toggleOverlay(): void {
        if (!this.overlayIsShown) {
            this.addOverlay();

            return;
        }

        this.removeOverlay();
    }

    protected addOverlay(): void {
        if (this.modifiers.length) {
            this.overlayIsShown = true;
            this.overlay.showOverlay(this.modifiers[0], this.modifiers[1]);
        }
    }

    protected removeOverlay(): void {
        if (this.modifiers.length) {
            this.overlayIsShown = false;
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
