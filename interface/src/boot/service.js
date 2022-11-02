
import { boot } from 'quasar/wrappers'
import helper from '../Services/Helper/index.js'
import handler from '../Services/Handler/index.js'
import system from '../Services/System/index.js'
import S_static from '../Services/Static/index.js'
import Api from '../Services/Axios/index.js'
import Lang from '../Services/Lang/index.js'



export default boot(({ app }) => {
  app.config.globalProperties.$api = new Api()
  app.config.globalProperties.$Help = new helper()
  app.config.globalProperties.$Handle = new handler()
  app.config.globalProperties.$Static = new S_static()
  app.config.globalProperties.$System = new system()
  app.config.globalProperties.$Lang = new Lang()

})
// export { api }
