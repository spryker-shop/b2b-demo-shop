import Component from 'ShopUi/models/component';

export default class ColorSelector extends Component {
    colors: HTMLAnchorElement[];
    image: HTMLImageElement;
    detailsLink: HTMLAnchorElement;

    protected readyCallback(): void {
        this.colors = <HTMLAnchorElement[]>Array.from(this.querySelectorAll(`.${this.jsName}__color`));
        this.image = <HTMLImageElement>document.querySelector(this.targetImageSelector);
        this.detailsLink = <HTMLAnchorElement>document.querySelector(this.targetDetailsLink);
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.colors.forEach((color: HTMLAnchorElement) => {
            color.addEventListener('mouseenter', (event: Event) => this.onColorSelection(event));
        });
    }

    protected onColorSelection(event: Event): void {
        event.preventDefault();
        const color = <HTMLAnchorElement>event.currentTarget;
        const imageSrc = color.getAttribute('data-image-src');
        const productUrl = color.getAttribute('href');
        this.setActiveColor(color);
        this.setImage(imageSrc);
        this.setProductUrl(productUrl);
    }

    setActiveColor(newColor: HTMLAnchorElement): void {
        this.colors.forEach((color: HTMLAnchorElement) => {
            color.classList.remove(this.colorActiveClass);
        });

        newColor.classList.add(this.colorActiveClass);
    }

    setImage(newImageSrc: string): void {
        if (this.image.src !== newImageSrc) {
            this.image.src = newImageSrc;
        }
    }

    setProductUrl(url: string): void {
        this.setProductHrefAttribute(this.detailsLink, url);
    }

    setProductHrefAttribute(link: HTMLAnchorElement, url: string): void {
        if (link.getAttribute('href') !== url) {
            link.setAttribute('href', url);
        }
    }

    protected get targetImageSelector(): string {
        return this.getAttribute('target-image-selector');
    }

    protected get targetDetailsLink(): string {
        return this.getAttribute('target-url-selector');
    }

    protected get colorActiveClass(): string {
        return this.getAttribute('active-color-class');
    }
}
