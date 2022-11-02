import axios from 'axios'
import Token from './properties'
import System from '../System/index.js'
import H_Language from '../Lang/index'
import Handler from '../Handler/index'
// INIT
const system = new System()
const api = axios.create(
  {
    baseURL: system.apiRoot(false),
    timeout: system.apiTimeout(),
  })


class Api {

  // CONSTRUCT API
  constructor() {
    this.api = api
    this.apiVersion = 'api/v1/'
    this.Lang = new H_Language()
    this.Handle = new Handler()
  }
  setAuthToken() {
    let token = this.Handle.getLS('_token')
    this.api.defaults.headers.common = { 'Authorization': `Bearer ${token}` }
    // console.log(token);
  }
  setDefaultHeader() {
    this.api.defaults.headers = { 'Accept': "application/json" }

  }

  get(endpoint, callback, error, firstSegment = null, responseType = 'json') {
    return this.R_validate('get', endpoint, null, callback, error, responseType, firstSegment)
  }
  delete(endpoint, callback, error, firstSegment = null, responseType = 'json') {
    return this.R_validate('delete', endpoint, null, callback, error, responseType, firstSegment)
  }
  put(endpoint, payload, callback, error, firstSegment = null, responseType = 'json') {
    return this.R_validate('put', endpoint, payload, callback, error, responseType, firstSegment)
  }
  post(endpoint, payload, callback, error, firstSegment = null, responseType = 'json') {
    return this.R_validate('post', endpoint, payload, callback, error, responseType, firstSegment)
  }

  async R_validate(method, endpoint, payload, callback, error, responseType, firstSegment) {
    // IF FIRSTSEGMENT = null
    let url = ''
    if (firstSegment == null) url = this.apiVersion + this.Lang.getLang().toLowerCase() + '/' + endpoint
    else url = endpoint

    this.setDefaultHeader()
    this.setAuthToken()
    // GET METHOD

    if (method == 'get') {
      await this.api({ method, url, responseType: 'json' }).then(
        (response) => {
          const [data, status, message, raw_response] = [response.data.data, response.status, response.data.message, response]
          callback(data, status, message, raw_response)
        }
      ).catch((e) => {
        if (e && e.response) {
          const [errorMessage, errorStatus, errorHeaders] = [e.response.data, e.response.status, e.response.headers]
          if (errorStatus == 401) {

            error(e.response)
          }
        }
      })
    }
    //DELETE
    if (method == 'delete') {
      await this.api({ method, url, responseType: 'json' }).then(
        (response) => {
          const [data, status, message, raw_response] = [response.data.data, response.status, response.data.message, response]
          callback(data, status, message, raw_response)
        }
      ).catch((e) => {
        if (e && e.response) {
          const [errorMessage, errorStatus, errorHeaders] = [e.response.data, e.response.status, e.response.headers]
          error(errorMessage, errorStatus, errorHeaders)
        }
      })
    }
    // PUT
    if (method == 'put') {
      await this.api({ method, url, data: payload, responseType: 'json' }).then(
        (response) => {
          const [data, status, message, raw_response] = [response.data.data, response.status, response.data.message, response]
          callback(data, status, message, raw_response)

        }
      ).catch((e) => {
        if (e && e.response) {
          const [errorMessage, errorStatus, errorHeaders] = [e.response.data, e.response.status, e.response.headers]
          error(errorMessage, errorStatus, errorHeaders)
        }
      })
    }
    if (method == 'post') {
      await this.api({ method, url, data: payload, responseType: 'json' }).then(
        (response) => {
          const [data, status, message, raw_response] = [response.data.data, response.status, response.data.message, response]
          callback(data, status, message, raw_response)
        }
      ).catch((e) => {
        if (e && e.response) {
          const [errorMessage, errorStatus, errorHeaders] = [e.response.data, e.response.status, e.response.headers]
          error(errorMessage, errorStatus, errorHeaders)
        }
      })
    }

  }


}


// SAME LIKE {...Token}
Object.assign(Api.prototype, Token)

export default Api


