import Storage from './storage'
import Notify from './notify'
import {
  Loading,
  exportFile,
  useQuasar,
  QSpinnerPie
} from 'quasar'



class Handler {
  constructor() {
    this.Loading = Loading
  }

  // TABLE HANDLE
  structureTable(columns) {
    let table = {
      search: null,
      columns,
      rows: [],
      pagination: {
        sortBy: 'id',
        descending: true,
        page: 1,
        rowsPerPage: 15,
        rowsNumber: null,


      },
      selected: [],
      visibleColumns: []
    }

    table.columns.forEach((val) => {
      table.visibleColumns.push(val.name)
    })
    return table
  }
  transformDesc(column, desc) {
    if (column == null) return 'id:ASC'
    if (desc === true) return `${column}:DESC`
    else return `${column}:ASC`
  }

  // LOADING
  loadingStart(spinner = QSpinnerPie, spinnerColor = 'primary', message = 'please wait...', messageColor = 'dark', backgroundColor = '', spinnerSize = '100', delay = '400') {
    return this.Loading.show(
      {
        spinner: spinner,
        spinnerColor: spinnerColor,
        message: message,
        messageColor: messageColor,
        backgroundColor: backgroundColor,
        spinnerSize: spinnerSize,
        delay: delay
      }
    )
  }
  loadingStop() {
    setTimeout(() => {
      this.Loading.hide()
    }, 2000);
  }

  wrapCsvValue(val, formatFn, row) {
    let formatted = formatFn !== void 0
      ? formatFn(val, row)
      : val
    formatted = formatted === void 0 || formatted === null
      ? ''
      : String(formatted)
    formatted = formatted.split('"').join('""')
    return `"${formatted}"`
  }

  exportTable(columns, rows) {
    // naive encoding to csv format
    const content = [columns.map(col => this.wrapCsvValue(col.label))].concat(
      rows.map(row => columns.map(col => this.wrapCsvValue(
        typeof col.field === 'function'
          ? col.field(row)
          : row[col.field === void 0 ? col.name : col.field],
        col.format,
        row
      )).join(','))
    ).join('\r\n')

    const status = exportFile(
      'table-export.csv',
      content,
      'text/csv'
    )

    if (status !== true) {
      this.errorMessage({
        message: 'Browser denied file download...',
        color: 'negative',
        icon: 'warning'
      })
    }
  }

}



Object.assign(Handler.prototype, Storage)
Object.assign(Handler.prototype, Notify)



export default Handler
