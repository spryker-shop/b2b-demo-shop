import Component from 'ShopUi/models/component';

export default class ColorSelector extends Component {
    colors: HTMLAnchorElement[]
    images: HTMLImageElement[]

    readyCallback() {
        this.colors = <HTMLAnchorElement[]>Array.from(this.getElementsByClassName(`${this.componentSelector}__color`));
        this.images = <HTMLImageElement[]>Array.from(document.querySelectorAll(this.targetImageSelector));
        this.mapEvents();
    }

    mapEvents() {
        this.colors.forEach((color: HTMLAnchorElement) => {
            color.addEventListener('mouseenter', (event: Event) => this.onColorSelection(event));
            color.addEventListener('click', (event: Event) => this.onColorSelection(event));
        });
    }

    onColorSelection(event: Event) {
        event.preventDefault();

        const color = <HTMLAnchorElement>event.currentTarget;
        const imageSrc = color.getAttribute('data-image-src');
        this.changeImage(imageSrc);
    }

    changeImage(newImageSrc: string) {
        this.images.forEach((image: HTMLImageElement) => {
            if (image.src !== newImageSrc) {
                image.src = newImageSrc;
            }
        });
    }

    get targetImageSelector(): string {
        return this.getAttribute('target-image-selector');
    }
}
