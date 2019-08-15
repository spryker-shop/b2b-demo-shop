import Component from 'ShopUi/models/component';

export default class ColorSelector extends Component {
    parent: HTMLElement | Document;
    parentSelector: string = '.product-card';
    currentColor: HTMLAnchorElement;
    colors: HTMLAnchorElement[];
    imageContainer: HTMLElement;
    image: HTMLImageElement;
    detailsLink: HTMLAnchorElement;

    protected readyCallback(): void {
        this.parent = <HTMLElement | Document>this.closest(this.parentSelector) || document;
        this.initializeProperties();
        this.mapEvents();
    }

    protected initializeProperties(colorSelector: Element = this, parent: Element | Document = this.parent): void {
        this.colors = <HTMLAnchorElement[]>Array.from(colorSelector.getElementsByClassName(`${this.jsName}__color`));
        this.imageContainer = <HTMLImageElement>parent.getElementsByClassName(this.targetImageContainerClassName)[0];
        this.image = <HTMLImageElement>this.imageContainer.getElementsByTagName('img')[0];
        this.detailsLink = <HTMLAnchorElement>parent.getElementsByClassName(this.targetDetailsLinkClassName)[0];
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
                    this.initializeProperties(colorSelector, parent);
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
            color.classList.remove(this.colorActiveClassName);
        });

        newColor.classList.add(this.colorActiveClassName);
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
