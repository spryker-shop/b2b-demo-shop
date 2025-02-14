import Component from 'ShopUi/models/component';
import flatpickr from 'flatpickr';
import { German } from 'flatpickr/dist/l10n/de.js';
import { Options } from 'flatpickr/dist/types/options';
import rangePlugin from 'flatpickr/dist/plugins/rangePlugin';

export default class DateTimePicker extends Component {
    protected trigger: HTMLInputElement;

    protected readyCallback(): void {}

    protected init(): void {
        this.trigger = this.querySelector<HTMLInputElement>('input[type="text"]');

        this.datePickerInit();
    }

    protected datePickerInit(): void {
        const config: Options = {
            locale: this.language === 'de' ? German : '',
            enableTime: true,
            ...this.config,
            ...(this.dateToId
                ? {
                      // eslint-disable-next-line new-cap
                      plugins: [new rangePlugin({ input: `#${this.dateToId}` })],
                  }
                : {}),
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

    protected get config(): object {
        return JSON.parse(this.getAttribute('config'));
    }

    protected get language(): string {
        return this.getAttribute('language');
    }
}
