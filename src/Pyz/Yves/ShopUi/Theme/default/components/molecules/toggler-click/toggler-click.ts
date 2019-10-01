import TogglerClickCore from 'ShopUi/components/molecules/toggler-click/toggler-click';

export default class TogglerClick extends TogglerClickCore {
    protected disablers: HTMLElement[];

    protected init(): void {
        const triggerClassNames: string[] | undefined = this.triggerClassName ?
            this.triggerClassName.split('.') : undefined;
        const targetClassNames: string[] | undefined = this.targetClassName ?
            this.targetClassName.split('.') : undefined;

        if (triggerClassNames) {
            this.saveCollectionToProperty('triggersList', triggerClassNames);
        }

        if (targetClassNames) {
            this.saveCollectionToProperty('targetsList', targetClassNames);
        }

        if (this.disablerClassName) {
            const disablerClassNamesList = this.disablerClassName.split(',');

            this.saveCollectionToProperty('disablers', disablerClassNamesList);
        }

        this.mapEvents();
    }

    protected mapEvents(): void {
        super.mapEvents();

        if (this.disablers) {
            this.disablers.forEach((disabler: HTMLElement) => {
                disabler.addEventListener('click', (event: Event) => this.removeClassToToggle());
            });
        }
    }

    protected saveCollectionToProperty(propertyName: string, classes: string[]): void {
        if (!classes.length) {
            return;
        }

        let property: HTMLElement[];

        classes.forEach((className, index) => {
            if (!index) {
                property = <HTMLElement[]>Array.from(document.getElementsByClassName(className));

                return;
            }

            property = [...property, Object.assign(document.getElementsByClassName(className))];
        });

        this[propertyName] = <HTMLElement[]>property;
    }

    protected removeClassToToggle(): void {
        this.targetsList.forEach((target: HTMLElement) => {
            target.classList.remove(this.classToToggle);
        });
    }

    toggle(): void {
        this.onTriggerToggleClass(event);

        super.toggle();
    }

    protected onTriggerToggleClass(event: Event): void {
        if (!this.triggerClassToToggle.length) {
            return;
        }

        const triggerTarget = <HTMLElement>event.currentTarget;

        triggerTarget.classList.toggle(this.triggerClassToToggle);
    }

    protected get triggerClassToToggle(): string {
        return this.getAttribute('trigger-class-to-toggle');
    }

    protected get disablerClassName(): string {
        return this.getAttribute('disabler-class-name');
    }
}
