import Vue from 'vue'
import toastr from 'toastr'
import 'toastr/toastr.scss'
toastr.options.progressBar = true
toastr.options.showMethod = 'slideDown'
toastr.options.rtl = true
Vue.prototype.toastr = toastr
Vue.use(toastr)
