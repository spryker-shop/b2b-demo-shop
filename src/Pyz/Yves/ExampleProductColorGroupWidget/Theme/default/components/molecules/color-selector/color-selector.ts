import Component from 'ShopUi/models/component';

export default class ColorSelector extends Component {
    colors: HTMLAnchorElement[]
    images: HTMLImageElement[]
    links: HTMLElement[]
    detailsLink: HTMLAnchorElement[]

    protected readyCallback(): void {
        this.colors = <HTMLAnchorElement[]>Array.from(this.getElementsByClassName(`${this.jsName}__color`));
        this.links = <HTMLElement[]>Array.from(document.querySelectorAll(this.targetLinkSelector));
        this.detailsLink = <HTMLAnchorElement[]>Array.from(document.querySelectorAll(this.targetDetailsLink));
        this.images = <HTMLImageElement[]>Array.from(document.querySelectorAll(`${this.targetLinkSelector}`));
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
        this.setProductDetailsUrl(productUrl);
    }

    setActiveColor(newColor: HTMLAnchorElement): void {
        this.colors.forEach((color: HTMLAnchorElement) => {
            color.classList.remove(`${this.name}__color--active`);
        });

        newColor.classList.add(`${this.name}__color--active`);
    }

    setImage(newImageSrc: string): void {
        this.images.forEach((image: HTMLImageElement) => {
            if (image.src !== newImageSrc) {
                image.src = newImageSrc;
            }
        });
    }

    setProductUrl(url: string): void {
        this.links.forEach((link: HTMLElement) => {
            console.log(link);
            if (link.getAttribute('href') !== url) {
                link.setAttribute('href', url);
            }
        });
    }

    setProductDetailsUrl(url: string): void {
        this.detailsLink.forEach((link: HTMLElement) => {
            if (link.getAttribute('href') !== url) {
                link.setAttribute('href', url);
            }
        });
    }

    get targetLinkSelector(): string {
        return this.getAttribute('target-image-selector');
    }

    get targetDetailsLink(): string {
        return this.getAttribute('target-url-selector');
    }
}
