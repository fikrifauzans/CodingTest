export default {
  transformList(val, setup) {
    let list = Object.assign({}, val)
    setup.destroy.forEach(destroy => {
      delete list[destroy];
    });

    return list
  },

  transformQuery(obj) {
    let query = ''
    if (obj != null) {
      for (const [key, value] of Object.entries(obj)) {
        if (value) query += `${key}:${value}|`
      }
      return query.slice(0, -1);
    }
    else return ''
  },

  transformField(val, field) {
    if (val == null) return ''
    else {
      let fields = field.split('.')
      fields.forEach(field => {
        val = val[field] ? val[field] : false
      });
      return val ? val : ''
    }
  }
}

