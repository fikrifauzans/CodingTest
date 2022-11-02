
import { LocalStorage } from 'quasar'


class Lang {
  constructor() {
    this.key = 'lang'
    this.list = ['EN', 'ID']
  }


  setLang(initial = null) {
    if (initial == null) initial = 'EN'
    LocalStorage.set(this.key, initial)
    const val = LocalStorage.getItem(this.key)
    location.reload();
    return val
  }

  getLang() {
    const val = LocalStorage.getItem(this.key)
    return val ? val : 'EN'
  }
}


export default Lang
