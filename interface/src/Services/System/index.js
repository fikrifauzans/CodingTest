class System {

  // API CONFIG
  apiRoot(prod = false) {
    if (prod) return 'https://url-production.com/'
    else return 'http://localhost:8090/'
  }
  apiTimeout() { return 10000 }
}

export default System
