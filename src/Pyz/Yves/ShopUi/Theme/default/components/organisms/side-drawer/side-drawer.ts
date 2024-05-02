import SideDrawerCore from 'ShopUi/components/organisms/side-drawer/side-drawer';

export default class SideDrawer extends SideDrawerCore {
    protected overlay: HTMLElement;
    protected isOverlayShown: boolean;

    protected init(): void {
        this.overlay = <HTMLElement>document.getElementsByClassName(this.overlayClassName)[0];

        super.init();
    }

    protected mapEvents(): void {
        super.mapEvents();

        this.mapWindowResizeEvent();
    }

    protected mapWindowResizeEvent(): void {
        window.addEventListener('resize', () => {
            if (!this.classList.contains(`${this.name}--show`)) {
                return;
            }

            if (window.innerWidth >= this.overlayBreakpoint && this.isOverlayShown) {
                this.toggleOverlay(false);

                return;
            }

            if (window.innerWidth < this.overlayBreakpoint && !this.isOverlayShown) {
                this.toggleOverlay(true);
            }
        });
    }

    protected mapOverlayEvents(): void {
        super.mapOverlayEvents();

        if (this.shouldCloseByOverlayClick) {
            this.mapOverlayClickEvent();
        }
    }

    protected mapOverlayClickEvent(): void {
        this.overlay.addEventListener('click', () => this.toggle(false));
    }

    toggle(isShownForced?: boolean): void {
        const isShown = isShownForced ?? !this.classList.contains(`${this.name}--show`);

        this.classList.toggle(`${this.name}--show`, isShown);
        this.containers.forEach((conatiner: HTMLElement) =>
            conatiner.classList.toggle(this.lockedBodyClassName, isShown),
        );
        this.toggleOverlay(isShown);
    }

    protected toggleOverlay(isShown: boolean): void {
        super.toggleOverlay(isShown);

        this.isOverlayShown = isShown;
    }

    protected get lockedBodyClassName(): string {
        return this.getAttribute('locked-body-class-name');
    }

    protected get overlayClassName(): string {
        return this.getAttribute('overlay-class-name');
    }

    protected get shouldCloseByOverlayClick(): boolean {
        return this.hasAttribute('should-close-by-overlay-click');
    }

    protected get overlayBreakpoint(): number {
        return Number(this.getAttribute('overlay-breakpoint'));
    }
}
