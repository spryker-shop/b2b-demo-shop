import Component from 'ShopUi/models/component';
import flatpickr from 'flatpickr';
import { German } from 'flatpickr/dist/l10n/de.js';
import { Options } from 'flatpickr/dist/types/options';

export default class DateTimePicker extends Component {
    protected trigger: HTMLInputElement;
    protected dateInput: HTMLInputElement;
    protected dateFromPicker: HTMLInputElement;
    protected dateToPicker: HTMLInputElement;
    protected calendarButton: HTMLButtonElement;

    protected readyCallback(): void {}

    protected init(): void {
        this.dateInput = this.querySelector<HTMLInputElement>(`.${this.name}__field`);
        this.dateInput.value = this.dateInput.value ? this.formattedDateTime : '';
        this.trigger = this.querySelector<HTMLInputElement>(`.${this.name}__flatpicker-input`);
        this.calendarButton = this.querySelector<HTMLButtonElement>(`.${this.name}__calendar-button`);
        this.dateFromPicker = document.querySelector(`[data-id="${this.dateFromId}"]`);
        this.dateToPicker = document.querySelector(`[data-id="${this.dateToId}"]`);

        this.mountEvents();
        this.datePickerInit();
    }

    protected mountEvents(): void {
        this.calendarButton.addEventListener('click', () => this.trigger.focus());
        this.dateInput.addEventListener('blur', () => this.trigger._flatpickr.setDate(this.dateInput.value, true));
    }

    protected datePickerInit(): void {
        const config: Options = {
            locale: this.language === 'de' ? German : 'default',
            enableTime: true,
            ...this.config,
            onChange: (selectedDates, dateStr) => {
                this.dateInput.value = dateStr;
                this.dateFromPicker?._flatpickr.set('maxDate', dateStr);
                this.dateToPicker?._flatpickr.set('minDate', dateStr);
            },
        };

        flatpickr(this.trigger, config);

        if (this.formattedDateTime && this.trigger.value) {
            this.trigger.value = this.formattedDateTime;
        }
    }

    protected get formattedDateTime(): string {
        return this.getAttribute('formatted-date-time');
    }

    protected get dateToId(): string {
        return this.getAttribute('date-to-id');
    }

    protected get dateFromId(): string {
        return this.getAttribute('date-from-id');
    }

    protected get config(): object {
        return JSON.parse(this.getAttribute('config'));
    }

    protected get language(): string {
        return this.getAttribute('language');
    }
}
