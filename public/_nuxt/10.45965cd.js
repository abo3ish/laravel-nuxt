(window.webpackJsonp=window.webpackJsonp||[]).push([[10],{113:function(e,t,r){"use strict";r.r(t);r(191),r(29);var n=r(10),o=r(63),c={layout:"admin",middleware:"auth",head:function(){return{title:this.$t("service_provider_types")}},data:function(){return{isBusy:!1,rows:1,perPage:0,currentPage:1,filter:{name:"",age:"",email:"",phone:"",address:"",type_id:""},query:{},serviceProviders:[],serviceProviderTypes:[],sortBy:"id",sortDesc:!1,fields:[{key:"id",sortable:!0},{key:"title",sortable:!0},{key:"description",sortable:!0},{key:"slug",sortable:!0},{key:"actions",sortable:!1}]}},watch:{currentPage:{handler:function(e){this.fetchData()}}},mounted:function(){this.fetchData()},methods:{fetchData:function(){var e=this;return Object(n.a)(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return e.query.page=e.currentPage,e.isBusy=!0,t.next=4,e.$axios.$get("service-provider-types").then((function(t){e.rows=t.pagination.total,e.perPage=t.pagination.per_page,e.currentPage=t.pagination.current_page,e.serviceProviderTypes=t.data,e.isBusy=!1}));case 4:case"end":return t.stop()}}),t)})))()},deleteAction:function(e,t){var r=this;return Object(n.a)(regeneratorRuntime.mark((function t(){var n,c;return regeneratorRuntime.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return n="service-provider-types/".concat(e,"/delete"),t.next=3,Object(o.b)(n);case 3:!0===t.sent&&(c=r.serviceProviderTypes.findIndex((function(element){return element.id===e})),r.serviceProviderTypes.splice(c,1));case 5:case"end":return t.stop()}}),t)})))()},searchFilter:function(){this.currentPage=1,this.serializeFilter(this.filter,this.query),this.fetchData().catch((function(){}))},serializeFilter:function(filter,e){for(var t in filter)e[t]=filter[t]}}},d=r(12),component=Object(d.a)(c,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("header-info",{attrs:{name:"service_provider_types",navigation:[{name:"home",link:"dashboard"},{name:"service_provider_types",link:""}]}}),e._v(" "),r("section",{staticClass:"content"},[r("div",{staticClass:"container-fluid"},[r("div",{staticClass:"row"},[r("div",{staticClass:"col-sm-12"},[r("div",{staticClass:"card card-primary"},[r("div",{staticClass:"card-header"},[r("n-link",{attrs:{to:{name:"create-service-provider-type"}}},[r("button",{staticClass:"btn btn-outline-light float-left"},[e._v("\n                  "+e._s(e.$t("add_new"))+"\n                ")])])],1),e._v(" "),r("div",{staticClass:"card card-body"},[r("b-table",{attrs:{items:e.serviceProviderTypes,busy:e.isBusy,fields:e.fields,"sort-by":e.sortBy,"sort-desc":e.sortDesc,"per-page":"0","current-page":e.currentPage,responsive:"sm",hover:"",striped:"","show-empty":"",stacked:"md"},on:{"update:busy":function(t){e.isBusy=t},"update:sortBy":function(t){e.sortBy=t},"update:sort-by":function(t){e.sortBy=t},"update:sortDesc":function(t){e.sortDesc=t},"update:sort-desc":function(t){e.sortDesc=t}},scopedSlots:e._u([{key:"table-busy",fn:function(){return[r("div",{staticClass:"text-center text-primary my-2"},[r("b-spinner",{staticClass:"align-middle",attrs:{variant:"primary"}}),e._v(" "),r("strong",[e._v("...تحميل")])],1)]},proxy:!0},{key:"cell(actions)",fn:function(data){return[r("b-button",{attrs:{to:{name:"show-service-provider-type",params:{id:data.item.id}},variant:"info",size:"sm"}},[e._v("\n                    Show\n                  ")]),e._v(" "),r("b-button",{attrs:{to:{name:"edit-service-provider-type",params:{id:data.item.id}},variant:"secondary",size:"sm"}},[e._v("\n                    Edit\n                  ")]),e._v(" "),r("b-button",{attrs:{variant:"danger",size:"sm"},on:{click:function(t){return t.stopPropagation(),t.preventDefault(),e.deleteAction(data.item.id,t)}}},[e._v("\n                    Delete\n                  ")])]}}])})],1)]),e._v(" "),r("b-pagination",{attrs:{"total-rows":e.rows,"per-page":e.perPage},model:{value:e.currentPage,callback:function(t){e.currentPage=t},expression:"currentPage"}})],1)])])])],1)}),[],!1,null,null,null);t.default=component.exports}}]);