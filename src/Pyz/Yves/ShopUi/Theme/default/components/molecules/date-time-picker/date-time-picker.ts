import Component from 'ShopUi/models/component';
import $ from 'jquery/dist/jquery';
import 'jquery-datetimepicker/build/jquery.datetimepicker.full';

export default class DateTimePicker extends Component {
    protected trigger: HTMLInputElement;

    protected readyCallback(): void {
        this.trigger = <HTMLInputElement>this.querySelector(this.triggerSelector);
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.datetimepickerInit();
        this.setLanguage(this.language);
    }

    protected datetimepickerInit(): void {
        $(this.trigger).datetimepicker(this.config);
    }

    protected setLanguage(language: string): void {
        $.datetimepicker.setLocale(language);
    }

    get parent(): string {
        return this.getAttribute('parent-id');
    }

    get triggerSelector(): string {
        return this.getAttribute('trigger-selector');
    }

    get language(): string {
        return this.getAttribute('language');
    }

    get config(): object {
        const config = JSON.parse(this.getAttribute('config'));
        config.parentID = this.parent;

        return config;
    }
}
