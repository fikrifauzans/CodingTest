export default {
  name: "Menus",
  module: 'menus',
  schema: 'auth',  // IF USE PGSQL
  module_name: 'Management Account',

  // USE MODAL
  formType: {
    show: false,
    edit: false,
    add: false
  },
  model: {
    name: null,
    link: null,
    icon: null,
    path: null,

  },
  //TABLE
  table: {
    columns: (Help, Lang, Static) => {
      return [
        { name: "id", label: "Option", field: "id", sortable: true, align: "left", },
        { name: "name", label: "Name", field: "name", sortable: true, align: "left", },
        { name: "icon", label: "Icon", field: "icon", sortable: true, align: "left", },
        { name: "path", label: "Path", field: "path", sortable: true, align: "left", },

      ]
    }
  }
}
