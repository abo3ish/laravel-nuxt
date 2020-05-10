import axios from 'axios'
import swal from 'sweetalert2'
import { fireSwal } from './sweetAlert'

process.env.NODE_TLS_REJECT_UNAUTHORIZED = '0'
export default ({ app, store, redirect, $axios }) => {
  if (process.server) {
    return
  }
  $axios.onError((error) => {
    if (error.response.status === 422) {
      store.dispatch('validation/setErrors', error.response.data.errors)
    }
    return Promise.reject(error)
  })

  $axios.onRequest(() => {
    store.dispatch('validation/clearErrors')
  })

  // Request interceptor
  axios.interceptors.request.use((request) => {
    request.baseURL = process.env.apiUrl

    const token = app.store.$axios.defaults.headers.common.Authorization
    // console.log(token)
    if (token) {
      request.headers.common.Authorization = token
    }

    const locale = store.getters['lang/locale']
    if (locale) {
      request.headers.common['Accept-Language'] = locale
    }

    return request
  })

  // Response interceptor
  axios.interceptors.response.use(response => response, (error) => {
    const { status } = error.response || {}
    if (status >= 500) {
      swal({
        type: 'error',
        title: app.i18n.t('error_alert_title'),
        text: app.i18n.t('error_alert_text'),
        reverseButtons: true,
        confirmButtonText: app.i18n.t('ok'),
        cancelButtonText: app.i18n.t('cancel')
      })
    }

    if (status === 401 && store.getters['auth/check']) {
      swal({
        type: 'warning',
        title: app.i18n.t('token_expired_alert_title'),
        text: app.i18n.t('token_expired_alert_text'),
        reverseButtons: true,
        confirmButtonText: app.i18n.t('ok'),
        cancelButtonText: app.i18n.t('cancel')
      }).then(() => {
        store.commit('auth/LOGOUT')

        redirect({ name: 'login' })
      })
    }

    if (status === 405) {
      fireSwal('error', app.i18n.t('error_alert_text'))
    }

    return Promise.reject(error)
  })
}
