import Vue from 'vue'

import HeaderInfo from '~/components/page/HeaderInfo'
import Loading from '~/components/global/loading'

const components = { HeaderInfo, Loading }

Object.entries(components).forEach(([name, component]) => {
  Vue.component(name, component)
})
