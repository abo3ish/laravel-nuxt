(window.webpackJsonp=window.webpackJsonp||[]).push([[28],{202:function(t,n,e){"use strict";e.r(n);e(29);var r=e(10),d={layout:"admin",middleware:"auth",head:function(){return{title:this.ad.slug}},components:{Loading:e(106).default},data:function(){return{loading:!0,ad:{}}},mounted:function(){this.loading=!0,this.fetchData()},methods:{fetchData:function(){var t=this;return Object(r.a)(regeneratorRuntime.mark((function n(){return regeneratorRuntime.wrap((function(n){for(;;)switch(n.prev=n.next){case 0:return n.next=2,t.$axios.$get("advertisements/"+t.$route.params.id).then((function(n){t.ad=n}));case 2:t.loading=!1;case 3:case"end":return n.stop()}}),n)})))()}}},o=(e(349),e(12)),component=Object(o.a)(d,(function(){var t=this,n=t.$createElement,e=t._self._c||n;return e("div",[t.loading?e("loading"):t._e(),t._v(" "),e("header-info",{attrs:{name:"ads",navigation:[{name:"home",link:"dashboard"},{name:"ads",link:"ads"},{name:t.ad.slug,link:"",trans:!1}]}}),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-12"},[e("div",{staticClass:"card card-primary"},[e("div",{staticClass:"card-header"},[e("h3",{staticClass:"card-title"},[t._v("\n            "+t._s(t.ad.name)+"\n            "),e("n-link",{attrs:{to:{name:"edit-ad"}}},[e("button",{staticClass:"btn btn-outline-light float-left"},[t._v("\n                "+t._s(t.$t("edit"))+"\n              ")])])],1)]),t._v(" "),e("div",{staticClass:"card-body"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"name"}},[t._v(t._s(t.$t("slug"))+" : ")]),t._v(" "),e("code",[t._v("\n              "+t._s(t.ad.slug)+" "),e("br")])]),t._v(" "),e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"position"}},[t._v(t._s(t.$t("position"))+" : ")]),t._v(" "),e("code",[t._v("\n              "+t._s(t.ad.position)+" "),e("br")])]),t._v(" "),e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"status"}},[t._v(t._s(t.$t("status"))+" : ")]),t._v(" "),t.ad.status?e("b-badge",{attrs:{variant:"success"}},[t._v("\n              "+t._s(t.$t("activated"))+"\n            ")]):e("b-badge",{attrs:{variant:"danger"}},[t._v("\n              "+t._s(t.$t("not_activated"))+"\n            ")])],1),t._v(" "),e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"image"}},[t._v(t._s(t.$t("image"))+" : ")]),t._v(" "),e("b-img",{attrs:{fluid:"",src:t.ad.image}})],1)])])])])],1)}),[],!1,null,"b3d6f73c",null);n.default=component.exports},336:function(t,n,e){},349:function(t,n,e){"use strict";var r=e(336);e.n(r).a}}]);