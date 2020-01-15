import TogglerClickCore from 'ShopUi/components/molecules/toggler-click/toggler-click';

export default class TogglerClick extends TogglerClickCore {
    protected onTriggerClick(event: Event): void {
        super.onTriggerClick(event);
        this.onTriggerToggleClass(event);
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
}
