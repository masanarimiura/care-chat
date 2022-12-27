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
  message: '「半角数字,+,()」以外が入力されています。国内の番号であれば、数字のみの入力をお願いします。',
  validate(value) {
    if (value.match(/(!(.)\1{2,}55)+$/)) {
      return true;
    }
  }
});