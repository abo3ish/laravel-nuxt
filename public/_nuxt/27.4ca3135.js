(window.webpackJsonp=window.webpackJsonp||[]).push([[27],{199:function(t,e,r){"use strict";r.r(e);r(29);var n=r(10),o=r(47),c=r.n(o),d={layout:"admin",middleware:"auth",head:function(){return{}},data:function(){return{user:{id:"",name:"",phone:"",email:"",age:"",address:"",status:"",orders:[],type:{id:"",title:""},last_seen:"",created_at:""},orders:[],options:[],form:new c.a({service_provider_id:"",price_to_pay:""})}},mounted:function(){var t=this;return Object(n.a)(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,t.fetchData();case 2:case"end":return e.stop()}}),e)})))()},methods:{fetchData:function(){var t=this;return Object(n.a)(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,t.$axios.$get("users/"+t.$route.params.id).then((function(e){t.user=e}));case 2:case"end":return e.stop()}}),e)})))()},update:function(){var t=this;this.form.put("/orders/"+this.$route.params.id,this.form).then((function(e){t.order=e.data}))},fetchOptions:function(t,e){var r=this;e(!0),setTimeout((function(){r.$axios.$get("users",{params:{name:t}}).then((function(t){r.options=t.data,console.log(t.data),e(!1)}))}),300)}}},l=(r(348),r(12)),component=Object(l.a)(d,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("section",{staticClass:"content-header"},[r("div",{staticClass:"container-fluid"},[r("div",{staticClass:"row mb-2"},[r("div",{staticClass:"col-sm-6"},[r("h1",[t._v(t._s(t.$t("users")))])]),t._v(" "),r("div",{staticClass:"col-sm-6"},[r("ol",{staticClass:"breadcrumb float-sm-left"},[r("li",{staticClass:"breadcrumb-item"},[r("nuxt-link",{attrs:{to:{name:"home"}}},[t._v("\n                "+t._s(t.$t("home"))+"\n              ")])],1),t._v(" "),r("li",{staticClass:"breadcrumb-item active"},[r("nuxt-link",{attrs:{to:{name:"users"}}},[t._v("\n                "+t._s(t.$t("users"))+"\n              ")])],1),t._v(" "),r("li",{staticClass:"breadcrumb-item active"})])])])])]),t._v(" "),r("div",{staticClass:"row"},[r("div",{staticClass:"col-md-12"},[r("div",{staticClass:"card card-primary"},[r("div",{staticClass:"card-header"},[r("h3",{staticClass:"card-title"},[t._v("\n            "+t._s(t.user.name+" - "+t.user.type.title)+"\n            "),r("n-link",{attrs:{to:{name:"edit-service-provider"}}},[r("button",{staticClass:"btn btn-outline-light float-left"},[t._v("\n                "+t._s(t.$t("edit"))+"\n              ")])])],1)]),t._v(" "),r("div",{staticClass:"card-body"},[r("div",{staticClass:"form-group"},[r("label",{attrs:{for:"balance"}},[t._v(t._s(t.$t("name"))+" : ")]),t._v(" "),r("code",[t._v("\n              "+t._s(t.user.name)+" "),r("br")])]),t._v(" "),r("div",{staticClass:"form-group"},[r("label",{attrs:{for:"balance"}},[t._v(t._s(t.$t("age"))+" : ")]),t._v(" "),r("code",[t._v("\n              "+t._s(t.user.age)+"\n            ")])]),t._v(" "),r("div",{staticClass:"form-group"},[r("label",{attrs:{for:"balance"}},[t._v(t._s(t.$t("email"))+" : ")]),t._v(" "),r("code",[t._v("\n              "+t._s(t.user.email)+"\n            ")])]),t._v(" "),r("div",{staticClass:"form-group"},[r("label",{attrs:{for:"balance"}},[t._v(t._s(t.$t("status"))+" : ")]),t._v(" "),r("code",[t._v("\n              "+t._s(t.user.status?t.$t("active"):t.$t("not_active"))+" "),r("br")])]),t._v(" "),r("div",{staticClass:"form-group"},[r("label",{attrs:{for:"balance"}},[t._v(t._s(t.$t("address"))+" : ")]),t._v(" "),r("code",{attrs:{id:"address"}},[t._v("\n              "+t._s(t.user.address)+" "),r("br")])]),t._v(" "),r("div",{staticClass:"form-group"},[r("label",{attrs:{for:"balance"}},[t._v(t._s(t.$t("service_provider_type"))+" : ")]),t._v(" "),r("code",[t._v("\n              "+t._s(t.user.type.title)+" "),r("br")])]),t._v(" "),r("div",{staticClass:"form-group"},[r("label",[t._v(t._s(t.$t("last_seen"))+" : ")]),t._v(" "),r("code",[t._v("\n              "+t._s(t.$moment(String(t.user.last_seen),"YYYY-MM-DD").format("LLLL"))+" "),r("br")])]),t._v(" "),r("div",{staticClass:"form-group"},[r("label",{attrs:{for:"balance"}},[t._v(t._s(t.$t("orders"))+" : ")]),t._v(" "),r("code",[r("nuxt-link",{attrs:{to:{name:"orders",query:{service_provider_id:t.user.id}}}},[t._v(t._s(t.$t("orders")))]),t._v(" |\n            ")],1),t._v(" "),r("label",{attrs:{for:"balance"}},[t._v(t._s(t.$t("orders_count"))+" : ")]),t._v(" "),r("code",[t._v("\n              "+t._s(t.user.orders.length)+"\n            ")])]),t._v(" "),r("div",{staticClass:"form-group"},[r("label",[t._v(t._s(t.$t("created_at"))+" : ")]),t._v(" "),r("code",[t._v("\n              "+t._s(t.$moment(String(t.user.created_at),"YYYY-MM-DD").format("LLLL"))+" "),r("br")])])])])])])])}),[],!1,null,"ec5a8248",null);e.default=component.exports},335:function(t,e,r){},348:function(t,e,r){"use strict";var n=r(335);r.n(n).a}}]);