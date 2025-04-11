import Component from 'ShopUi/models/component';
import flatpickr from 'flatpickr';
import { German } from 'flatpickr/dist/l10n/de.js';
import { Options } from 'flatpickr/dist/types/options';
import Instance = flatpickr.Instance;

export default class DateTimePicker extends Component {
    protected trigger: HTMLInputElement;
    protected dateFromPicker: Instance | Instance[];
    protected dateToPicker: Instance | Instance[];

    protected readyCallback(): void {}

    protected init(): void {
        this.trigger = this.querySelector<HTMLInputElement>('input[type="text"]');

        this.datePickerInit();
    }

    protected datePickerInit(): void {
        const config: Options = {
            locale: this.language === 'de' ? German : 'default',
            enableTime: true,
            allowInput: true,
            ...this.config,
            onChange: (selectedDates, dateStr) => {
                const dateFromPickerInstance = document.querySelector(`#${this.dateFromId}`)?._flatpickr;
                const dateToPickerInstance = document.querySelector(`#${this.dateToId}`)?._flatpickr;
                dateFromPickerInstance?.set('maxDate', dateStr);
                dateToPickerInstance?.set('minDate', dateStr);
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
