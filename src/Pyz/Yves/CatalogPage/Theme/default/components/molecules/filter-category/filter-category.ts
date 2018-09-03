import Component from 'ShopUi/models/component';

export default class FilterCategory extends Component {
    readonly item: HTMLElement;
    items: HTMLElement[];

    constructor() {
        super();
        this.item = <HTMLElement>document.querySelector(this.listSelector);
        this.items = <HTMLElement[]>Array.from(this.item.querySelectorAll(this.itemSelector));
    }

    protected readyCallback(): void {
        if (this.item.classList.contains(this.parentSelector)) {
            this.searchElements(this.items);
        } else {
            let target = <HTMLElement> this.item;
            while (!target.classList.contains(this.wrapSelector)) {
                if (target.classList.contains(this.parentSelector)) {
                    this.searchElements(<HTMLElement[]>Array.from(target.querySelectorAll(this.itemSelector)));
                    return;
                }
                target = <HTMLElement> target.parentNode;
            }
        }
    }

    protected searchElements(items): void {
        for (let i = 0; i <= items.length - 1; i++) {
            this.classRemove(items[i]);
        }
    }

    protected classRemove(activeTrigger: HTMLElement): void {
        activeTrigger.classList.remove(this.classToRemove);
    }

    get wrapSelector(): string {
        return this.getAttribute('wrap-selector');
    }

    get parentSelector(): string {
        return this.getAttribute('parent-selector');
    }

    get listSelector(): string {
        return this.getAttribute('list-selector');
    }

    get itemSelector(): string {
        return this.getAttribute('item-selector');
    }

    get classToRemove(): string {
        return this.getAttribute('change-class');
    }
}