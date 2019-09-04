import Component from 'ShopUi/models/component';

export default class FilterCategory extends Component {
    protected activeCategory: HTMLElement;
    protected categoriesToShow: HTMLElement[];
    protected parent: HTMLElement;

    protected readyCallback(): void {}

    protected init(): void {
        this.activeCategory = <HTMLElement>document.getElementsByClassName(this.listClassName)[0];
        this.parent = this.activeCategory ? this.activeCategory : this;
        this.categoriesToShow = <HTMLElement[]>Array.from(
            this.parent.getElementsByClassName(this.categoriesToShowClassName));

        this.removeVisibilityClass();
    }

    protected removeVisibilityClass(): void {
        if (!this.activeCategory || this.activeCategory.classList.contains(this.parentClassName)) {
            this.removeClass(this.categoriesToShow);

            return;
        }

        this.removeVisibilityClasses();
    }

    protected removeVisibilityClasses(): void {
        let target = <HTMLElement>this.activeCategory;

        while (!target.classList.contains(this.wrapClassName)) {
            if (target.classList.contains(this.parentClassName)) {
                this.removeClass(<HTMLElement[]>Array.from(
                    target.getElementsByClassName(this.categoriesToShowClassName)
                ));

                return;
            }

            target = <HTMLElement>target.parentNode;
        }
    }

    protected removeClass(categoriesToShow: HTMLElement[]): void {
        categoriesToShow.forEach((element: HTMLElement) => element.classList.remove(this.classToRemove));
    }

    protected get wrapClassName(): string {
        return this.getAttribute('wrap-class-name');
    }

    protected get parentClassName(): string {
        return this.getAttribute('parent-class-name');
    }

    protected get listClassName(): string {
        return this.getAttribute('list-class-name');
    }

    protected get categoriesToShowClassName(): string {
        return this.getAttribute('category-class-name');
    }

    protected get classToRemove(): string {
        return this.getAttribute('change-class');
    }
}
