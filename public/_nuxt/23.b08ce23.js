(window.webpackJsonp=window.webpackJsonp||[]).push([[23],{199:function(t,e,n){"use strict";n.r(e);n(30);var r=n(10),c={layout:"admin",middleware:"auth",head:function(){return{title:this.ad.slug}},components:{Loading:n(186).default},data:function(){return{ad:{}}},mounted:function(){this.fetchData()},methods:{fetchData:function(){var t=this;return Object(r.a)(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,t.$axios.$get("advertisements/"+t.$route.params.id).then((function(e){console.log(e),t.ad=e}));case 2:case"end":return e.stop()}}),e)})))()}}},o=(n(337),n(12)),component=Object(o.a)(c,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[t.ad.id?t._e():n("loading"),t._v(" "),n("section",{staticClass:"content-header"},[n("div",{staticClass:"container-fluid"},[n("div",{staticClass:"row mb-2"},[n("div",{staticClass:"col-sm-6"},[n("h1",[t._v(t._s(t.$t("ads")))])]),t._v(" "),n("div",{staticClass:"col-sm-6"},[n("ol",{staticClass:"breadcrumb float-sm-left"},[n("li",{staticClass:"breadcrumb-item"},[n("nuxt-link",{attrs:{to:{name:"home"}}},[t._v("\n                "+t._s(t.$t("home"))+"\n              ")])],1),t._v(" "),n("li",{staticClass:"breadcrumb-item active"},[n("nuxt-link",{attrs:{to:{name:"ads"}}},[t._v("\n                "+t._s(t.$t("ads"))+"\n              ")])],1),t._v(" "),n("li",{staticClass:"breadcrumb-item active"})])])])])]),t._v(" "),n("div",{staticClass:"row"},[n("div",{staticClass:"col-md-12"},[n("div",{staticClass:"card card-primary"},[n("div",{staticClass:"card-header"},[n("h3",{staticClass:"card-title"},[t._v("\n            "+t._s(t.ad.name)+"\n            "),n("n-link",{attrs:{to:{name:"edit-ad"}}},[n("button",{staticClass:"btn btn-outline-light float-left"},[t._v("\n                "+t._s(t.$t("edit"))+"\n              ")])])],1)]),t._v(" "),n("div",{staticClass:"card-body"},[n("div",{staticClass:"form-group"},[n("label",{attrs:{for:"name"}},[t._v(t._s(t.$t("slug"))+" : ")]),t._v(" "),n("code",[t._v("\n              "+t._s(t.ad.slug)+" "),n("br")])]),t._v(" "),n("div",{staticClass:"form-group"},[n("label",{attrs:{for:"position"}},[t._v(t._s(t.$t("position"))+" : ")]),t._v(" "),n("code",[t._v("\n              "+t._s(t.ad.position)+" "),n("br")])]),t._v(" "),n("div",{staticClass:"form-group"},[n("label",{attrs:{for:"status"}},[t._v(t._s(t.$t("status"))+" : ")]),t._v(" "),t.ad.status?n("b-badge",{attrs:{variant:"success"}},[t._v("\n              "+t._s(t.$t("activated"))+"\n            ")]):n("b-badge",{attrs:{variant:"danger"}},[t._v("\n              "+t._s(t.$t("not_activated"))+"\n            ")])],1),t._v(" "),n("div",{staticClass:"form-group"},[n("label",{attrs:{for:"image"}},[t._v(t._s(t.$t("image"))+" : ")]),t._v(" "),n("b-img",{attrs:{fluid:"",src:t.ad.image}})],1)])])])])],1)}),[],!1,null,"8c270164",null);e.default=component.exports},323:function(t,e,n){},337:function(t,e,n){"use strict";var r=n(323);n.n(r).a}}]);