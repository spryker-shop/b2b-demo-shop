import Component from 'ShopUi/models/component';

export default class ShoppingListNoteToggler extends Component {
    protected label: HTMLElement;
    protected trigger: HTMLElement;
    protected noteTextFieldWrapper: HTMLElement;
    protected noteTextarea: HTMLFormElement;
    protected hiddenClass = 'is-hidden';

    protected readyCallback(): void {}

    protected init(): void {
        this.label = <HTMLElement>this.getElementsByClassName(`${this.jsName}__label`)[0];
        this.trigger = <HTMLElement>this.getElementsByClassName(`${this.jsName}__title`)[0];
        this.noteTextFieldWrapper = <HTMLFormElement>this.getElementsByClassName(`${this.jsName}__wrapper`)[0];
        this.noteTextarea = <HTMLFormElement>this.getElementsByClassName(`${this.jsName}__note-textarea`)[0];
        this.mapEvents();
    }

    protected mapEvents(): void {
        if (this.label) {
            this.label.addEventListener('click', (event: Event) => this.onClick(event));
        }
    }

    private onClick(event: Event): void {
        event.preventDefault();
        this.toggleClass([this.label, this.trigger, this.noteTextFieldWrapper]);
        this.focusTextarea();
    }

    private toggleClass(elementsToToggle: HTMLElement[]): void {
        elementsToToggle.forEach((element) => {
            element.classList.toggle(this.hiddenClass);
        });
    }

    private focusTextarea(): void {
        this.noteTextarea.focus();
    }
}
