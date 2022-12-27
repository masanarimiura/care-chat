import Vue from 'vue';
import { ValidationProvider, ValidationObserver, extend, localize } from 'vee-validate';
import * as originalRules from 'vee-validate/dist/rules';
import ja from 'vee-validate/dist/locale/ja.json';
import { PhoneNumberUtil } from 'google-libphonenumber'


let rule;
for (rule in originalRules) {
  extend(rule, {
    ...originalRules[rule],
  });
}

localize('ja', ja);

Vue.component('ValidationProvider', ValidationProvider);
Vue.component('ValidationObserver', ValidationObserver);

// google-libphonenumber追加したカスタムルール、電話番号、+ - と数字
extend('phone', {
  message: 'The {_field_} field format is invalid',
  validate(value) {
    const util = PhoneNumberUtil.getInstance()
    try {
      const phoneNumber = util.parseAndKeepRawInput(value, 'JP')
      return util.isValidNumber(phoneNumber)
    } catch (err) {
      return false
    }
  }
})