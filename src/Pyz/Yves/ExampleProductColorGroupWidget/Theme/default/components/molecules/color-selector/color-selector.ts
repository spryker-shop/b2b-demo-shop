import Component from 'ShopUi/models/component';

export default class ColorSelector extends Component {
    colors: HTMLAnchorElement[];
    imageContainer: HTMLElement;
    image: HTMLImageElement;
    detailsLink: HTMLAnchorElement;

    protected readyCallback(): void {
        this.colors = <HTMLAnchorElement[]>Array.from(this.getElementsByClassName(`${this.jsName}__color`));
        this.imageContainer = <HTMLImageElement>document.getElementsByClassName(this.targetImageContainerClassName)[0];
        this.image = <HTMLImageElement>this.imageContainer.getElementsByTagName('img')[0];
        this.detailsLink = <HTMLAnchorElement>document.getElementsByClassName(this.targetDetailsLinkClassName)[0];
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
            color.classList.remove(this.colorActiveClassName);
        });

        newColor.classList.add(this.colorActiveClassName);
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

    protected get targetImageContainerClassName(): string {
        return this.getAttribute('target-image-container-class-name');
    }

    protected get targetDetailsLinkClassName(): string {
        return this.getAttribute('target-details-link-class-name');
    }

    protected get colorActiveClassName(): string {
        return this.getAttribute('active-color-class-name');
    }
}
