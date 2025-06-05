import ActionSingleClickEnforcerCore from 'ShopUi/components/molecules/action-single-click-enforcer/action-single-click-enforcer';

export default class ActionSingleClickEnforcer extends ActionSingleClickEnforcerCore {
    protected onTargetClick(event: Event): void {
        const targetElement = <HTMLElement>event.currentTarget;
        const isLink: boolean = targetElement.matches('a');
        const isDisabled: boolean = targetElement.hasAttribute('disabled') || Boolean(targetElement.dataset.disabled);

        if (isDisabled) {
            event.preventDefault();

            return;
        }

        if (isLink) {
            event.preventDefault();
            const link = <HTMLLinkElement>targetElement;
            this.disableLink(event, link);

            return;
        }

        const form: HTMLFormElement = targetElement.closest('form');
        const buttonType = targetElement.getAttribute('type');
        const isSubmit = buttonType === 'submit';
        const isButtonSubmit = targetElement.matches('button') && !buttonType;

        if (form && (isSubmit || isButtonSubmit)) {
            form.addEventListener('submit', () => {
                this.disableButton(targetElement);
            });
        }
    }
}
