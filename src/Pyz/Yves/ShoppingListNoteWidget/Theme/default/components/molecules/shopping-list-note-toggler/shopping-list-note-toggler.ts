import Component from 'ShopUi/models/component';

export default class ShoppingListNoteToggler extends Component {
    label: HTMLElement;
    trigger: HTMLElement;
    noteTextFieldWrapper: HTMLElement;
    noteTextarea: HTMLFormElement;
    hiddenClass: string;

    protected readyCallback(): void {
        this.label = <HTMLElement>this.querySelector(`.${this.jsName}__label`);
        this.trigger = <HTMLElement>this.querySelector(`.${this.jsName}__title`);
        this.noteTextFieldWrapper = <HTMLFormElement>this.querySelector(`.${this.jsName}__wrapper`);
        this.noteTextarea = <HTMLFormElement>this.querySelector(`.${this.jsName}__note-textarea`);
        this.hiddenClass = 'is-hidden';
        this.mapEvents();
    }

    protected mapEvents(): void {
        if(this.label) {
            this.label.addEventListener('click', (event: Event) => this.onClick(event))
        }
    }

    private onClick(event: Event): void {
        event.preventDefault();
        this.toggleClass([this.label, this.trigger, this.noteTextFieldWrapper]);
        this.focusTextarea();
    }

    private toggleClass(listOfElements:Array<HTMLElement>): void {
        listOfElements.forEach((element) => {
            element.classList.toggle(this.hiddenClass);
        });
    }

    private focusTextarea(): void {
        this.noteTextarea.focus();
    }
}
