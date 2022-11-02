export default {
  name: "Permissions",
  module: 'permissions',
  schema: 'auth',  // IF USE PGSQL
  module_name: 'Management Account',

  // USE MODAL
  formType: {
    show: true,
    edit: true,
    add: false
  },
  model: {
    name: null,
    username: null,
    email: null,
    address: null,
    password: null,
  },
  //TABLE
  table: {
    columns: (Help, Lang, Static) => {
      return [
        { name: "status", label: "Status", field: "status", sortable: true, align: "left", },
        { name: "name", label: "Name", field: "name", sortable: true, align: "center", },
        { name: "slug", label: "Slug", field: "slug", sortable: true, align: "left", },

      ]
    }
  }
}
