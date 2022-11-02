import { LocalStorage, SessionStorage } from 'quasar'

export default {
  setLS(key, value) {
    LocalStorage.set(key, value)
    const val = LocalStorage.getItem(key)
    return val ? val : false
  },
  getLS(key) {
    const val = LocalStorage.getItem(key)
    return val ? val : false
  },
  setSS(key, value) {
    SessionStorage.set(key, value)
    const val = SessionStorage.getItem(key)
    return val ? val : false
  },
  getSS(key) {
    const val = SessionStorage.getItem(key)
    return val ? val : false
  },
  clearAllLS() {
    return LocalStorage.clear()
  }


}
