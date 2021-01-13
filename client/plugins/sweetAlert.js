import Vue from 'vue'
import Swal from 'sweetalert2'
import 'sweetalert2/src/sweetalert2.scss'

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true
})

Vue.prototype.$swal = Swal

Vue.prototype.fireSwal = (icon, title) => {
  Toast.fire({ icon, title })
}

export function fireSwal (icon, title) {
  Toast.fire({ icon, title })
}
