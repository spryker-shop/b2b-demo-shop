import ColorSelector from '../color-selector/color-selector';

export default class ColorSelectorPdp extends ColorSelector {
    container: HTMLElement

    protected readyCallback(): void {
        this.colors = <HTMLAnchorElement[]>Array.from(this.querySelectorAll(`.${this.jsName}__color`));
        this.image = <HTMLImageElement>document.querySelector(this.targetImageSelector);
        this.container = <HTMLElement>document.querySelector(this.imageContainerSelector);
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.colors.forEach((color: HTMLAnchorElement, i: Number) => {
            if (i !== 0) {
                color.addEventListener('mouseenter', (event: Event) => this.onColorSelection(event));
                color.addEventListener('mouseout', (event: Event) => this.onColorUnselection(event));
            }
        });
    }

    protected onColorSelection(event: Event): void {
        event.preventDefault();
        const color = <HTMLAnchorElement>event.target;
        const imageSrc = color.getAttribute('data-image-src');
        this.setActiveColor(color);
        this.setActiveImage(imageSrc);
    }

    protected onColorUnselection(event: Event): void {
        event.preventDefault();
        this.setActiveColor(this.colors[0]);
        this.resetActiveImage();
    }

    protected setActiveImage(newImageSrc: string): void {
        if (this.image.src !== newImageSrc) {
            this.image.src = newImageSrc;
            this.container.classList.add(this.imageActiveClass);
        }
    }

    protected resetActiveImage(): void {
        this.container.classList.remove(this.imageActiveClass);
    }

    get imageActiveClass(): string {
        return this.getAttribute('active-image-class');
    }

    get imageContainerSelector(): string {
        return this.getAttribute('target-selector');
    }
}
