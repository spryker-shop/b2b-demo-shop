import TogglerClickCore from 'ShopUi/components/molecules/toggler-click/toggler-click';

export default class TogglerClick extends TogglerClickCore {
    protected disablers: HTMLElement[] = [];

    protected init(): void {
        if (this.disablerClassName) {
            const disablerClassNamesList = this.disablerClassName.split(',');

            disablerClassNamesList.forEach(disablerClassName => {
                this.disablers = <HTMLElement[]>
                    [...this.disablers, ...Array.from(document.getElementsByClassName(disablerClassName))];
            });
        }

        super.init();
    }

    protected mapEvents(): void {
        super.mapEvents();

        this.disablers.forEach((disabler: HTMLElement) => {
            disabler.addEventListener('click', (event: Event) => this.removeClassToToggle());
        });
    }

    protected removeClassToToggle(): void {
        this.targets.forEach((target: HTMLElement) => {
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
