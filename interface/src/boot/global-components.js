
import { boot } from 'quasar/wrappers'

// SYSTEM
import Menu from '../components/system/Menu.vue'
import Filter from '../components/system/Filter.vue'
import Brand from '../components/system/Brand.vue'
import Header from '../components/system/HeaderCms.vue'
import TopTable from '../components/system/TopTable.vue'
import Loading from '../components/system/Loading.vue'
import TableOption from '../components/system/TableOption.vue'
import FormHeader from '../components/system/FormHeader.vue'
import AccountButton from '../components/system/AccountButton.vue'
// TOOLS FUNCTION
import Modal from '../components/tools/Modal.vue'
import Input from '../components/tools/Input.vue'
import List from '../components/tools/List.vue'
import SelectApi from '../components/tools/SelectApi.vue'
import Select from '../components/tools/Select.vue'
import DateInput from '../components/tools/DateInput.vue'


export default boot(async ({ app }) => {
  app.component('s-menu', Menu)
  app.component('s-filter', Filter)
  app.component('s-brand', Brand)
  app.component('s-drawer', Header)
  app.component('s-top-table', TopTable)
  app.component('s-loading', Loading)
  app.component('s-table-option', TableOption)
  app.component('s-form', FormHeader)
  app.component('s-account', AccountButton)

  app.component('t-modal', Modal)
  app.component('t-input', Input)
  app.component('t-select-api', SelectApi)
  app.component('t-select', Select)
  app.component('t-date', DateInput)
  app.component('t-list', List)
})
