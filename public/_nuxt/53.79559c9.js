(window.webpackJsonp=window.webpackJsonp||[]).push([[53],{221:function(e,r,t){"use strict";t.r(r);t(30);var d=t(10),o={layout:"admin",middleware:"auth",head:function(){return{title:this.order.uuid}},data:function(){return{order:{id:"",uuid:"",user:{},address:{},type:"",status:{},services:{},drugs:{},attachments:[],prices:{},profits:{},created_at:"",is_collected:"",service_provider_type:"",service_provider:{},audio:"",dates:{}},servicesFields:["title","service_provider_type","estimated_price","price_to_pay","discount_price","discount"],drugsFields:["name","price","price_to_pay","discount_price","discount"]}},mounted:function(){this.fetchOrder()},methods:{fetchOrder:function(){var e=this;this.$axios.$get("/orders/"+this.$route.params.id).then((function(r){e.order=r}))},playAudio:function(e){e.loading=!0,e.rowFile||this.loadFile(e)},pauseAudio:function(e){e.loading=!0,e.audio&&e.audio.pause()},loadFile:function(e){var r=this;return Object(d.a)(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,r.$axios.$get("/attachments/"+e.id,{responseType:"blob"}).then((function(r){var t=new FileReader;t.readAsDataURL(r),t.onload=function(){e.rowFile=t.result,e.loading=!1,e.ready=!0}}));case 2:case"end":return t.stop()}}),t)})))()}}},n=t(12),component=Object(n.a)(o,(function(){var e=this,r=e.$createElement,t=e._self._c||r;return t("div",[e.order.id?e._e():t("loading"),e._v(" "),t("header-info",{attrs:{name:"orders",navigation:[{name:"home",link:"dashboard"},{name:"orders",link:"orders"},{name:e.order.uuid,link:"",trans:!1}]}}),e._v(" "),t("div",{staticClass:"row"},[t("div",{staticClass:"col-md-12"},[t("div",{staticClass:"card card-primary"},[t("div",{staticClass:"card-header"},[t("h3",{staticClass:"card-title"},[e._v("\n            "+e._s(e.order.user.name+" - "+e.order.type+" - "+e.order.status.string)+"\n            "),t("n-link",{attrs:{to:{name:"edit-order"}}},[t("button",{staticClass:"btn btn-outline-light float-left"},[e._v("\n                "+e._s(e.$t("edit"))+"\n              ")])])],1)]),e._v(" "),t("div",{staticClass:"card-body"},[t("div",{staticClass:"form-group"},[t("label",{attrs:{for:"type"}},[e._v(e._s(e.$t("order_type"))+" : ")]),e._v(" "),t("code",{staticClass:"badge badge-info"},[e._v("\n              "+e._s(e.order.type)+" "),t("br")])]),e._v(" "),t("div",{staticClass:"form-group"},[t("label",{attrs:{for:"type"}},[e._v(e._s(e.$t("order_number"))+" : ")]),e._v(" "),t("code",{staticClass:"badge badge-danger"},[e._v("\n              "+e._s(e.order.uuid)+" "),t("br")])]),e._v(" "),t("div",{staticClass:"form-group"},[t("label",{attrs:{for:"username"}},[e._v(e._s(e.$t("username"))+" : ")]),e._v(" "),t("code",[e._v("\n              "+e._s(e.order.user.name)+" "),t("br")])]),e._v(" "),t("div",{staticClass:"form-group"},[t("label",{attrs:{for:"phone"}},[e._v(e._s(e.$t("phone"))+" : ")]),e._v(" "),t("code",[e._v("\n              "+e._s(e.order.user.phone)+"\n            ")])]),e._v(" "),t("div",{staticClass:"form-group"},[t("label",{attrs:{for:"status"}},[e._v(e._s(e.$t("status"))+" : ")]),e._v(" "),t("code",[e._v("\n              "+e._s(e.order.status.string)+" "),t("br")])]),e._v(" "),t("div",{staticClass:"form-group"},[t("label",{attrs:{for:"area"}},[e._v(e._s(e.$t("area"))+" : ")]),e._v(" "),t("code",{attrs:{id:"area"}},[e._v("\n              "+e._s(e.order.address.area)+"\n            ")]),e._v("\n            ||\n            "),t("label",{attrs:{for:"street"}},[e._v(e._s(e.$t("street"))+" : ")]),e._v(" "),t("code",{attrs:{id:"street",dir:"rtl"}},[e._v("\n              "+e._s(e.order.address.street)+"\n            ")]),e._v("\n            ||\n            "),t("label",{attrs:{for:"building_number"}},[e._v(e._s(e.$t("building_number"))+" : ")]),e._v(" "),t("code",{attrs:{id:"building_number"}},[e._v("\n              "+e._s(e.order.address.building_number)+"\n            ")]),e._v("\n            ||\n            "),t("label",{attrs:{for:"floor_number"}},[e._v(e._s(e.$t("floor_number"))+" : ")]),e._v(" "),t("code",{attrs:{id:"floor_number"}},[e._v("\n              "+e._s(e.order.address.floor_number)+"\n            ")]),e._v("\n            ||\n            "),t("label",{attrs:{for:"flat_number"}},[e._v(e._s(e.$t("flat_number"))+" : ")]),e._v(" "),t("code",{attrs:{id:"flat_number"}},[e._v("\n              "+e._s(e.order.address.flat_number)+"\n            ")]),e._v("\n            ||\n            "),t("a",{attrs:{href:"https://www.google.com/maps/search/?api=1&query="+e.order.address.lat+","+e.order.address.lat,target:"_blank"}},[e._v("\n              افتح علي الخريطة\n            ")])]),e._v(" "),t("div",{staticClass:"form-group"},[t("label",{attrs:{for:"service_provider"}},[e._v(e._s(e.$t("service_provider"))+" : ")]),e._v(" "),t("code",{attrs:{id:"service_provider"}},[e._v("\n              "+e._s(e.order.service_provider?e.order.service_provider.name:e.$t("service_provider_not_assigned"))+" "),t("br")])]),e._v(" "),t("div",{staticClass:"form-group"},[t("label",{attrs:{for:"is_collected"}},[e._v(e._s(e.$t("is_collected"))+" : ")]),e._v(" "),t("code",{attrs:{id:"is_collected"}},[e._v("\n              "+e._s(e.order.is_collected?e.$t("order_collected"):e.$t("order_not_collected"))+" "),t("br")])]),e._v(" "),t("div",{staticClass:"row"},[t("div",{staticClass:"col-3"},[t("table",{staticClass:"table table-responsive table-hover"},e._l(Object.keys(e.order.prices),(function(r){return t("tr",{key:r.id},[t("th",[e._v(e._s(e.$t(r)))]),e._v(" "),t("td",[e._v(e._s(e.order.prices[r]))])])})),0)]),e._v(" "),t("div",{staticClass:"col-3"},[t("table",{staticClass:"table table-responsive table-hover"},e._l(Object.keys(e.order.profits),(function(r){return t("tr",{key:r.id},[t("th",[e._v(e._s(e.$t(r)))]),e._v(" "),t("td",[e._v(e._s(e.order.profits[r]))])])})),0)]),e._v(" "),t("div",{staticClass:"col-6"},[t("table",{staticClass:"table table-striped table-responsive table-hover"},e._l(Object.keys(e.order.dates),(function(r){return t("tr",{key:r.id},[t("th",[e._v(e._s(e.$t(r)))]),e._v(" "),t("td",[e._v(e._s(e.order.dates[r]?e.$moment(String(e.order.dates[r]),"YYYY-MM-DD hh:mm:ss").format("LLLL"):""))])])})),0)])])])]),e._v(" "),e.order.services.length?t("div",{staticClass:"card card-primary"},[t("div",{staticClass:"card card-header"},[e._v("\n          Services\n        ")]),e._v(" "),t("div",{staticClass:"card card-body"},[t("b-table",{attrs:{items:e.order.services,fields:e.servicesFields,"show-empty":""}})],1)]):e._e(),e._v(" "),e.order.drugs.length?t("div",{staticClass:"card card-primary"},[t("div",{staticClass:"card card-header"},[e._v("\n          Products\n        ")]),e._v(" "),t("div",{staticClass:"card card-body"},[t("b-table",{attrs:{items:e.order.drugs,fields:e.drugsFields,"show-empty":""}})],1)]):e._e(),e._v(" "),e._l(e.order.attachments,(function(r){return t("div",{key:r.id,staticClass:"card card-indigo"},[r.ready?e._e():t("b-button",{attrs:{variant:"primary"},on:{click:function(t){return e.loadFile(r)}}},[r.loading?t("b-spinner",{attrs:{small:""}}):e._e(),e._v(" Load File\n        ")],1),e._v(" "),"audio"==r.type&&""!=r.rowFile?t("vue-plyr",[t("audio",[t("source",{attrs:{src:r.rowFile,type:r.mime}})])]):e._e(),e._v(" "),"text"==r.type||"image"==r.type?t("b-card-img",{attrs:{src:r.rowFile,thumbnail:"",fluid:""}}):e._e()],1)}))],2)])],1)}),[],!1,null,null,null);r.default=component.exports}}]);