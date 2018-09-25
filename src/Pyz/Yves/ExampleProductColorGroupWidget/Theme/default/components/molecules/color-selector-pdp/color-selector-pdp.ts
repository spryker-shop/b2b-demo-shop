import Component from 'ShopUi/models/component';

export default class ColorSelectorPdp extends Component {
    colors: HTMLAnchorElement[]
    container: HTMLElement
    image: HTMLImageElement
    imageActiveClass: string

    protected readyCallback(): void {
        this.colors = <HTMLAnchorElement[]>Array.from(this.getElementsByClassName(`${this.jsName}__color`));
        this.container = <HTMLElement>document.querySelector(this.imageContainerSelector);
        this.image = <HTMLImageElement>document.querySelector(this.imageSelector);
        this.imageActiveClass = 'image-gallery__item--color-active';
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

    setActiveColor(changedColor: HTMLAnchorElement): void {
        this.colors.forEach((color: HTMLAnchorElement) => {
            color.classList.remove(`${this.name}__color--active`);
        });

        changedColor.classList.add(`${this.name}__color--active`);
    }

    setActiveImage(newImageSrc: string): void {
        if (this.image.src !== newImageSrc) {
            this.image.src = newImageSrc;
            this.container.classList.add(this.imageActiveClass);
        }
    }

    protected onColorUnselection(event: Event): void {
        event.preventDefault();
        this.setActiveColor(this.colors[0]);
        this.removeImage();
    }

    removeImage(): void {
        this.container.classList.remove(this.imageActiveClass);
    }

    get imageContainerSelector(): string {
        return this.getAttribute('target-selector');
    }

    get imageSelector(): string {
        return this.getAttribute('target-image-selector');
    }
}
