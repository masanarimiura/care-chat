import Vue from 'vue';
import { ValidationProvider, ValidationObserver, extend, localize } from 'vee-validate';
import * as originalRules from 'vee-validate/dist/rules';
import ja from 'vee-validate/dist/locale/ja.json';

let rule;
for (rule in originalRules) {
  extend(rule, {
    ...originalRules[rule],
  });
}

localize('ja', ja);

Vue.component('ValidationProvider', ValidationProvider);
Vue.component('ValidationObserver', ValidationObserver);

// 追加したカスタムルール、電話番号、+ - と数字
extend('phone_number', {
  params: [
    {
      name: 'minimum',
      isTarget: true
    }
  ],
  // エラーメッセージの{_field_},{minimum}にはvalidation-providerタグのnameで指定した文字列が入る
  message: '{_field_}は半角数字と-+より大きい数値を入力してください',
  validate(value, { minimum }) {
    return value > minimum;
  }
});