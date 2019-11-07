import Component from 'ShopUi/models/component';

export default class BundleCheckbox extends Component {
    protected triggers: HTMLElement[];
    protected parents: HTMLElement[];

    protected readyCallback(): void {}

    protected init(): void {
        this.triggers = <HTMLElement[]>Array.from(document.getElementsByClassName(this.triggerClassName));
        this.parents = <HTMLElement[]>Array.from(document.getElementsByClassName(this.parentClassName))

        this.addUniqueClasses();
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.triggers.forEach((trigger: HTMLInputElement) => {
            trigger.addEventListener('change', (event: Event) => this.onTriggerChange(event));
        });
    }

    protected addUniqueClasses(): void {
        this.parents.forEach((parent: HTMLElement, index: number) => {
            Array.from(parent.getElementsByClassName(this.targetClassName)).forEach((checkbox: HTMLInputElement) => {
                const uniqueClass = `${this.targetClassName}${index}`;

                if (checkbox.classList.contains(this.triggerClassName)) {
                    checkbox.dataset.target = uniqueClass;
                }

                if (!checkbox.classList.contains(this.triggerClassName)) {
                    checkbox.classList.add(uniqueClass);
                }
            });
        });
    }

    protected onTriggerChange(event: Event): void {
        const target = <HTMLInputElement>event.target;
        const status = <boolean>target.checked;

        Array.from(document.getElementsByClassName(target.dataset.target)).forEach((input: HTMLInputElement) => {
            input.checked = status;
        });
    }

    protected get triggerClassName(): string {
        return this.getAttribute('trigger-class-name');
    }

    protected get targetClassName(): string {
        return this.getAttribute('target-class-name');
    }

    protected get parentClassName(): string {
        return this.getAttribute('parent-class-name');
    }
}
