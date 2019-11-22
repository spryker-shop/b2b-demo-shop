import ColorSelector from '../color-selector/color-selector';

export default class ColorSelectorPdp extends ColorSelector {
    protected container: HTMLElement;

    protected readyCallback(): void {}

    protected init(): void {
        this.colors = <HTMLAnchorElement[]>Array.from(this.getElementsByClassName(`${this.jsName}__color`));
        this.container = <HTMLElement>document.getElementsByClassName(this.imageContainerClassName)[0];
        this.image = <HTMLImageElement>this.container.getElementsByTagName('img')[0];
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.colors.forEach((color: HTMLAnchorElement, index: number) => {
            if (index !== 0) {
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
        if (this.image.src === newImageSrc) {
            return;
        }

        this.image.src = newImageSrc;
        this.container.classList.add(this.imageActiveClassName);
    }

    protected resetActiveImage(): void {
        this.container.classList.remove(this.imageActiveClassName);
    }

    protected get imageActiveClassName(): string {
        return this.getAttribute('active-image-class-name');
    }

    protected get imageContainerClassName(): string {
        return this.getAttribute('target-image-container-class-name');
    }
}
