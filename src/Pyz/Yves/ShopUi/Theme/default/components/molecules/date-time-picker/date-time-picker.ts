import Component from 'ShopUi/models/component';
import $ from 'jquery/dist/jquery';
import 'jquery-datetimepicker/build/jquery.datetimepicker.full';

export default class DateTimePicker extends Component {
    protected trigger: HTMLInputElement;
    protected dateFrom: HTMLInputElement;
    protected dateTo: HTMLInputElement;

    protected readyCallback(): void {}

    protected init(): void {
        this.trigger = <HTMLInputElement>this.getElementsByTagName('input')[0];
        this.dateFrom = <HTMLInputElement>document.getElementById(this.dateFromId);
        this.dateTo = <HTMLInputElement>document.getElementById(this.dateToId);

        this.mapEvents();
    }

    protected mapEvents(): void {
        this.datetimepickerInit();
        this.setLanguage(this.language);

        if (this.dateTo) {
            this.setMaxDate();
        }
        if (this.dateFrom) {
            this.setMinDate();
        }
    }

    protected datetimepickerInit(): void {
        if (this.formattedDateTime && $(this.trigger).val()) {
            $(this.trigger).val(this.formattedDateTime);
        }

        $(this.trigger).datetimepicker(this.config);
    }

    protected setLanguage(language: string): void {
        $.datetimepicker.setLocale(language);
    }

    protected setMaxDate(): void {
        const $dateFrom = $(this.trigger);
        const $dateTo = $(this.dateTo);

        $dateFrom.datetimepicker({
            onShow() {
                if (!$dateTo.val()) {
                    return;
                }

                this.setOptions({ maxDate: $dateTo.datetimepicker('getValue') });
            },
            onClose() {
                if (!$dateTo.val()) {
                    return;
                }

                const dateFromValue = $dateFrom.datetimepicker('getValue');
                const dateToValue = $dateTo.datetimepicker('getValue');

                if (dateFromValue > dateToValue) {
                    $dateTo.datetimepicker({ value: dateFromValue });
                }
            },
        });
    }

    protected setMinDate(): void {
        const $dateFrom = $(this.dateFrom);
        const $dateTo = $(this.trigger);

        $dateTo.datetimepicker({
            onShow() {
                if (!$dateFrom.val()) {
                    return;
                }

                this.setOptions({ minDate: $dateFrom.datetimepicker('getValue') });
            },
            onClose() {
                if (!$dateFrom.val()) {
                    return;
                }

                const dateFromValue = $dateFrom.datetimepicker('getValue');
                const dateToValue = $dateTo.datetimepicker('getValue');

                if (dateFromValue > dateToValue) {
                    $dateFrom.datetimepicker({ value: dateToValue });
                }
            },
        });
    }

    protected get parent(): string {
        return this.getAttribute('parent-id');
    }

    protected get language(): string {
        return this.getAttribute('language');
    }

    protected get config(): object {
        const config = JSON.parse(this.getAttribute('config'));
        config.parentID = this.parent;

        return config;
    }

    protected get formattedDateTime(): string {
        return this.getAttribute('formatted-date-time');
    }

    protected get dateFromId(): string {
        return this.getAttribute('date-from-id');
    }

    protected get dateToId(): string {
        return this.getAttribute('date-to-id');
    }
}
