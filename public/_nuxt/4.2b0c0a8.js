(window.webpackJsonp=window.webpackJsonp||[]).push([[4],{104:function(t,e,r){"use strict";r.r(e);r(29);var n=r(10),c={layout:"admin",middleware:"auth",data:function(){return{isBusy:!1,rows:1,perPage:0,currentPage:1,filter:{name:"",age:"",email:"",phone:"",address:"",type_id:""},query:{},serviceProviders:[],serviceProviderTypes:[],sortBy:"id",sortDesc:!1,fields:[{key:"id",sortable:!0},{key:"title",sortable:!0},{key:"description",sortable:!0},{key:"slug",sortable:!0},{key:"actions",sortable:!1}]}},watch:{currentPage:{handler:function(t){this.fetchData()}}},mounted:function(){this.fetchData()},methods:{fetchData:function(){var t=this;return Object(n.a)(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return t.query.page=t.currentPage,t.isBusy=!0,e.next=4,t.$axios.$get("service-provider-types").then((function(e){t.rows=e.pagination.total,t.perPage=e.pagination.per_page,t.currentPage=e.pagination.current_page,t.serviceProviderTypes=e.data,t.isBusy=!1}));case 4:case"end":return e.stop()}}),e)})))()},deleteItem:function(t,e){e.preventDefault(),alert(t)},searchFilter:function(){this.currentPage=1,this.serializeFilter(this.filter,this.query),this.fetchData()},serializeFilter:function(filter,t){for(var e in filter)t[e]=filter[e]}}},o=r(12),component=Object(o.a)(c,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("section",{staticClass:"content-header"},[r("div",{staticClass:"container-fluid"},[r("div",{staticClass:"row mb-2"},[r("div",{staticClass:"col-sm-6"},[r("h1",[t._v(t._s(t.$t("service_providers")))])]),t._v(" "),r("div",{staticClass:"col-sm-6"},[r("ol",{staticClass:"breadcrumb float-sm-left"},[r("li",{staticClass:"breadcrumb-item"},[r("nuxt-link",{attrs:{to:{name:"home"}}},[t._v("\n                "+t._s(t.$t("home"))+"\n              ")])],1),t._v(" "),r("li",{staticClass:"breadcrumb-item active"},[t._v("\n              "+t._s(t.$t("service_providers"))+"\n            ")])])])])])]),t._v(" "),r("section",{staticClass:"content"},[r("div",{staticClass:"container-fluid"},[r("div",{staticClass:"row"},[r("div",{staticClass:"col-sm-12"},[r("div",{staticClass:"card card-primary"},[r("div",{staticClass:"card-header"},[r("n-link",{attrs:{to:{name:"create-service-provider-type"}}},[r("button",{staticClass:"btn btn-outline-light float-left"},[t._v("\n                  "+t._s(t.$t("add_new"))+"\n                ")])])],1),t._v(" "),r("div",{staticClass:"card card-body"},[r("b-table",{attrs:{items:t.serviceProviderTypes,busy:t.isBusy,fields:t.fields,"sort-by":t.sortBy,"sort-desc":t.sortDesc,"per-page":"0","current-page":t.currentPage,responsive:"sm",hover:"",striped:"","show-empty":"",stacked:"md"},on:{"update:busy":function(e){t.isBusy=e},"update:sortBy":function(e){t.sortBy=e},"update:sort-by":function(e){t.sortBy=e},"update:sortDesc":function(e){t.sortDesc=e},"update:sort-desc":function(e){t.sortDesc=e}},scopedSlots:t._u([{key:"cell(type)",fn:function(data){return[r("span",[t._v(t._s(data.item.type.title))])]}},{key:"cell(status)",fn:function(data){return[data.item.status?r("b-badge",{attrs:{variant:"success"}},[t._v("\n                    "+t._s(t.$t("activated"))+"\n                  ")]):r("b-badge",{attrs:{variant:"danger"}},[t._v("\n                    "+t._s(t.$t("not_activated"))+"\n                  ")])]}},{key:"cell(last_seen)",fn:function(data){return[data.item.last_seen?r("span",[t._v("\n                    "+t._s(t.$moment(String(data.item.last_seen)).format("LLLL"))+"\n                  ")]):t._e()]}},{key:"cell(actions)",fn:function(data){return[r("b-button",{attrs:{to:{name:"show-service-provider",params:{id:data.item.id}},variant:"info",size:"sm"}},[t._v("\n                    Show\n                  ")]),t._v(" "),r("b-button",{attrs:{to:{name:"edit-service-provider-type",params:{id:data.item.id}},variant:"secondary",size:"sm"}},[t._v("\n                    Edit\n                  ")]),t._v(" "),r("b-button",{attrs:{variant:"danger",size:"sm"},on:{click:function(e){return e.stopPropagation(),e.preventDefault(),t.deleteItem(data.item.id,e)}}},[t._v("\n                    Delete\n                  ")])]}}])})],1)]),t._v(" "),r("b-pagination",{attrs:{"total-rows":t.rows,"per-page":t.perPage},model:{value:t.currentPage,callback:function(e){t.currentPage=e},expression:"currentPage"}})],1)])])]),t._v(" "),t._m(0)])}),[function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"card card-primary"},[e("div",{staticClass:"card-header"})])}],!1,null,null,null);e.default=component.exports}}]);