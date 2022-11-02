export default {
  name: "Dashboard",
  module: 'dashboard',
  schema: 'dashboard',  // IF USE PGSQL
  module_name: 'Dashboard',

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
        { name: "id", label: "Option", field: "id", sortable: true, align: "left", },
        { name: "name", label: "Name", field: "name", sortable: true, align: "left", },
        { name: "email", label: "Email", field: "email", sortable: true, align: "left", },
        { name: "username", label: "Username", field: "username", sortable: true, align: "left", },
        { name: "address", label: "Address", field: "address", sortable: true, align: "left", },
        { name: "role-name", label: "Role", field: (val) => Help.transformField(val, 'role.name'), sortable: true, align: "left", },
      ]
    }
  }
}
