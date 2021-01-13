import Vue from 'vue'
import axios from 'axios'

/**
 * Get cookie from request.
 *
 * @param  {Object} req
 * @param  {String} key
 * @return {String|undefined}
 */
export function cookieFromRequest (req, key) {
  if (!req.headers.cookie) {
    return
  }

  const cookie = req.headers.cookie.split(';').find(
    c => c.trim().startsWith(`${key}=`)
  )

  if (cookie) {
    return cookie.split('=')[1]
  }
}

/**
 * https://router.vuejs.org/en/advanced/scroll-behavior.html
 */
export function scrollBehavior (to, from, savedPosition) {
  if (savedPosition) {
    return savedPosition
  }

  let position = {}

  if (to.matched.length < 2) {
    position = { x: 0, y: 0 }
  } else if (to.matched.some(r => r.components.default.options.scrollToTop)) {
    position = { x: 0, y: 0 }
  } if (to.hash) {
    position = { selector: to.hash }
  }

  return position
}

export async function deleteItem (endpoint) {
  try {
    const res = await Vue.prototype.$swal.fire({
      title: 'هل تريد الاستمرار؟',
      icon: 'question',
      iconHtml: '؟',
      confirmButtonText: 'نعم',
      cancelButtonText: 'لا',
      showCancelButton: true,
      showCloseButton: true
    }).then(async (e) => {
      if (e.isConfirmed) {
        const data = await axios.post(endpoint)
        if (data.data) {
          Vue.prototype.fireSwal('success', Vue.prototype.i18n.t('deleted_successfully'))
          return true
        } else {
          Vue.prototype.fireSwal('error', Vue.prototype.i18n.t('something_wrong'))
          console.log('false catch something')
        }
      }
    })
    return res
  } catch {}
}
