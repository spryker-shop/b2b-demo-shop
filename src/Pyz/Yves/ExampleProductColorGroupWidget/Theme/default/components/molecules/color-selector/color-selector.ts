import Component from 'ShopUi/models/component';

export default class ColorSelector extends Component {
    parent: HTMLElement | Document;
    parentSelector: string = '.product-card';
    currentColor: HTMLAnchorElement;
    colors: HTMLAnchorElement[];
    image: HTMLImageElement;
    detailsLink: HTMLAnchorElement;

    protected readyCallback(): void {
        this.parent = <HTMLElement | Document>this.closest(this.parentSelector) || document;
        this.initialProperty();
        this.mapEvents();
    }

    protected initialProperty(colorSelector: Element = this, parent: Element | Document = this.parent): void {
        this.colors = <HTMLAnchorElement[]>Array.from(colorSelector.querySelectorAll(`.${this.jsName}__color`));
        this.image = <HTMLImageElement>parent.querySelector(this.targetImageSelector);
        this.detailsLink = <HTMLAnchorElement>parent.querySelector(this.targetDetailsLink);
    }

    protected mapEvents(): void {
        this.colors.forEach((color: HTMLAnchorElement) => {
            color.addEventListener('mouseenter', (event: Event) => {
                this.onColorSelection(event);
                this.colorSelectorsHandler();
            });
        });
    }

    protected colorSelectorsHandler(): void {
        if (this.parent instanceof HTMLElement && this.currentColor) {
            const slickSlider: Element = this.parent.closest('.slick-carousel');
            const colorSelectors: NodeListOf<Element> = slickSlider.querySelectorAll(`.${this.name}`);
            if (colorSelectors.length > 1) {
                colorSelectors.forEach(colorSelector => {
                    const parent = colorSelector.closest(this.parentSelector);
                    this.initialProperty(colorSelector, parent);
                    this.onSetColorSelector(this.currentColor);
                });
            }
        }
    }

    protected onColorSelection(event: Event): void {
        event.preventDefault();
        const color = <HTMLAnchorElement>event.currentTarget;
        this.onSetColorSelector(color);
    }

    protected onSetColorSelector(color: HTMLAnchorElement): void {
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
        this.currentColor = newColor;
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

    get targetImageSelector(): string {
        return this.getAttribute('target-image-selector');
    }

    get targetDetailsLink(): string {
        return this.getAttribute('target-url-selector');
    }

    get colorActiveClass(): string {
        return this.getAttribute('active-color-class');
    }
}
