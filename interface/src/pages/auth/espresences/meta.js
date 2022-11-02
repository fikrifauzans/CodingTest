export default {
  name: "Espresences",
  module: 'espresences',
  schema: 'auth',  // IF USE PGSQL
  module_name: 'Espresences',

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
        { name: "user-name", label: "User", field: (val) => Help.transformField(val, 'user.name'), sortable: true, align: "left", },
        { name: "type", label: "Type", field: "type", sortable: true, align: "left", },
        { name: "date", label: "Date", field: "date", sortable: true, align: "left", },
        { name: "is_aprove", label: "Is Aprove", field: "is_aprove", sortable: true, align: "left", },
        // { name: "role-name", label: "Role", field: (val) => Help.transformField(val, 'role.name'), sortable: true, align: "left", },


      ]
    }
  }
}
