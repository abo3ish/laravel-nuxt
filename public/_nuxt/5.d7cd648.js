(window.webpackJsonp=window.webpackJsonp||[]).push([[5],{109:function(t,e,r){"use strict";r.r(e);r(11),r(30);var n=r(10),l=r(308),o=r(311),c=r(309),d={layout:"admin",middleware:"auth",components:{LabelInputText:l.a,SubmitButton:o.a,SelectBox:c.a},data:function(){return{isBusy:!1,rows:1,perPage:0,currentPage:1,filter:{title:"",service_provider_type_id:"",examination_id:"",status:""},statuses:[{id:0,title:"not_active"},{id:1,title:"active"}],query:{},examinations:[],serviceProviderTypes:[],services:[],sortBy:"id",sortDesc:!1,fields:[{key:"id",sortable:!0},{key:"title",sortable:!0},{key:"service_provider_type",sortable:!0},{key:"examination",sortable:!0},{key:"parent",sortable:!0},{key:"status",sortable:!0},{key:"actions",sortable:!1}]}},watch:{currentPage:{handler:function(t){this.fetchData()}}},mounted:function(){this.fetchServiceProviderTypes(),this.fetchExaminations(),this.fetchData().catch((function(t){console.log(t)}))},methods:{fetchData:function(){var t=this;return Object(n.a)(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return t.query.page=t.currentPage,t.isBusy=!0,e.next=4,t.$axios.$get("services",{params:t.query}).then((function(e){t.rows=e.pagination.total,t.perPage=e.pagination.per_page,t.currentPage=e.pagination.current_page,t.services=e.data,t.isBusy=!1}));case 4:t.$router.replace({name:"services",query:t.query});case 5:case"end":return e.stop()}}),e)})))()},fetchServiceProviderTypes:function(){var t=this;this.$axios.$get("service-provider-types/all").then((function(e){t.serviceProviderTypes=e}))},fetchExaminations:function(){var t=this;this.$axios.$get("examinations").then((function(e){t.examinations=e}))},deleteItem:function(t,e){e.preventDefault(),alert(t)},searchFilter:function(){this.currentPage=1,this.serializeFilter(this.filter,this.query),this.fetchData()},serializeFilter:function(filter,t){for(var e in filter)t[e]=filter[e]}}},v=r(12),component=Object(v.a)(d,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("section",{staticClass:"content-header"},[r("div",{staticClass:"container-fluid"},[r("div",{staticClass:"row mb-2"},[r("div",{staticClass:"col-sm-6"},[r("h1",[t._v(t._s(t.$t("service_providers")))])]),t._v(" "),r("div",{staticClass:"col-sm-6"},[r("ol",{staticClass:"breadcrumb float-sm-left"},[r("li",{staticClass:"breadcrumb-item"},[r("nuxt-link",{attrs:{to:{name:"home"}}},[t._v("\n                "+t._s(t.$t("home"))+"\n              ")])],1),t._v(" "),r("li",{staticClass:"breadcrumb-item active"},[t._v("\n              "+t._s(t.$t("services"))+"\n            ")])])])])])]),t._v(" "),r("section",{staticClass:"filter content"},[r("form",{attrs:{role:"form"},on:{submit:function(e){return e.preventDefault(),t.searchFilter()}}},[r("div",{staticClass:"row"},[r("div",{staticClass:"col-2"},[r("label-input-text",{attrs:{label:t.$t("title"),type:"text",placeholder:"Enter Name",name:"title"},model:{value:t.filter.title,callback:function(e){t.$set(t.filter,"title",e)},expression:"filter.title"}})],1),t._v(" "),r("div",{staticClass:"col-2"},[r("select-box",{attrs:{label:t.$t("service_provider_type"),items:t.serviceProviderTypes,name:"service_provider_type_id"},model:{value:t.filter.service_provider_type_id,callback:function(e){t.$set(t.filter,"service_provider_type_id",e)},expression:"filter.service_provider_type_id"}})],1),t._v(" "),r("div",{staticClass:"col-2"},[r("select-box",{attrs:{label:t.$t("examination_type"),items:t.examinations,name:"examination_id"},model:{value:t.filter.examination_id,callback:function(e){t.$set(t.filter,"examination_id",e)},expression:"filter.examination_id"}})],1),t._v(" "),r("div",{staticClass:"col-2"},[r("select-box",{attrs:{label:t.$t("status"),items:t.statuses,name:"examination_id"},model:{value:t.filter.status,callback:function(e){t.$set(t.filter,"status",e)},expression:"filter.status"}})],1)]),t._v(" "),r("submit-button")],1)]),t._v(" "),r("section",{staticClass:"content"},[r("div",{staticClass:"container-fluid"},[r("div",{staticClass:"row"},[r("div",{staticClass:"col-sm-12"},[r("div",{staticClass:"card card-primary"},[r("div",{staticClass:"card-header"},[r("n-link",{attrs:{to:{name:"create-service"}}},[r("button",{staticClass:"btn btn-outline-light float-left"},[t._v("\n                  "+t._s(t.$t("add_new"))+"\n                ")])])],1),t._v(" "),r("div",{staticClass:"card card-body"},[r("b-table",{attrs:{items:t.services,busy:t.isBusy,fields:t.fields,"sort-by":t.sortBy,"sort-desc":t.sortDesc,"per-page":"0","current-page":t.currentPage,responsive:"sm",hover:"",striped:"","show-empty":"",stacked:"md"},on:{"update:busy":function(e){t.isBusy=e},"update:sortBy":function(e){t.sortBy=e},"update:sort-by":function(e){t.sortBy=e},"update:sortDesc":function(e){t.sortDesc=e},"update:sort-desc":function(e){t.sortDesc=e}},scopedSlots:t._u([{key:"table-busy",fn:function(){return[r("div",{staticClass:"text-center text-primary my-2"},[r("b-spinner",{staticClass:"align-middle",attrs:{variant:"primary"}}),t._v(" "),r("strong",[t._v("...تحميل")])],1)]},proxy:!0},{key:"cell(service_provider_type)",fn:function(data){return[t._v("\n                  "+t._s(data.item.service_provider_type.title)+"\n                ")]}},{key:"cell(examination)",fn:function(data){return[r("span",[t._v(t._s(data.item.examination.title))])]}},{key:"cell(parent)",fn:function(data){return[data.item.parent?r("span",[t._v(t._s(data.item.parent.title))]):t._e()]}},{key:"cell(status)",fn:function(data){return[data.item.status?r("b-badge",{attrs:{variant:"success"}},[t._v("\n                    "+t._s(t.$t("activated"))+"\n                  ")]):r("b-badge",{attrs:{variant:"danger"}},[t._v("\n                    "+t._s(t.$t("not_activated"))+"\n                  ")])]}},{key:"cell(actions)",fn:function(data){return[r("b-button",{attrs:{to:{name:"show-service",params:{id:data.item.id}},variant:"info",size:"sm"}},[t._v("\n                    Show\n                  ")]),t._v(" "),r("b-button",{attrs:{to:{name:"edit-service",params:{id:data.item.id}},variant:"secondary",size:"sm"}},[t._v("\n                    Edit\n                  ")]),t._v(" "),r("b-button",{attrs:{variant:"danger",size:"sm"},on:{click:function(e){return e.stopPropagation(),e.preventDefault(),t.deleteItem(data.item.id,e)}}},[t._v("\n                    Delete\n                  ")])]}}])})],1)]),t._v(" "),r("b-pagination",{attrs:{"total-rows":t.rows,"per-page":t.perPage},model:{value:t.currentPage,callback:function(e){t.currentPage=e},expression:"currentPage"}})],1)])])]),t._v(" "),t._m(0)])}),[function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"card card-primary"},[e("div",{staticClass:"card-header"})])}],!1,null,null,null);e.default=component.exports},308:function(t,e,r){"use strict";r(11),r(9);var n={name:"LabelInputText",props:{label:{required:!1,default:"",type:String},value:{required:!1,type:[String,Number],default:""},type:{required:!0,default:"text",type:String},placeholder:{required:!1,default:"",type:String},name:{required:!0,type:String}},computed:{idName:function(){return this.label.toLowerCase().replace(" ","-")+"-"+Math.floor(100*Math.random())}},methods:{updateValue:function(t){this.$emit("input",t)}}},l=r(12),component=Object(l.a)(n,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"form-group"},[t.label?r("label",{staticClass:"col-form-label",attrs:{for:t.idName}},[t._v(t._s(t.label))]):t._e(),t._v(" "),r("div",{staticClass:"input-group mb-3"},[r("input",{staticClass:"form-control",attrs:{id:t.idName,name:t.name,type:t.type,placeholder:t.placeholder},domProps:{value:t.value},on:{input:function(e){return t.updateValue(e.target.value)}}})])])}),[],!1,null,null,null);e.a=component.exports},309:function(t,e,r){"use strict";r(11),r(9);var n={name:"Selectbox",props:{label:{required:!1,default:"",type:String},items:{required:!0,type:[Array]},value:{required:!1,type:[String,Number],default:null},name:{required:!0,type:String}},computed:{idName:function(){return this.label.toLowerCase().replace(" ","-")+"-"+Math.floor(100*Math.random())}},methods:{updateValue:function(t){this.$emit("input",t)}}},l=r(12),component=Object(l.a)(n,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"form-group"},[t.label?r("label",{attrs:{for:t.idName}},[t._v(t._s(t.label))]):t._e(),t._v(" "),"object"==typeof t.items[0]?r("select",{staticClass:"form-control",attrs:{id:t.idName,name:t.name},domProps:{value:t.value},on:{input:function(e){return t.updateValue(e.target.value)}}},[r("option",{attrs:{value:"",selected:""}},[t._v("\n      "+t._s(t.$t("select"))+"\n    ")]),t._v(" "),t._l(t.items,(function(e){return r("option",{key:e.id,domProps:{value:e.id,selected:e.id==t.value?"selected":""}},[t._v("\n      "+t._s(e.title)+"\n    ")])}))],2):r("select",{staticClass:"form-control",attrs:{id:t.idName,name:t.name},domProps:{value:t.value},on:{input:function(e){return t.updateValue(e.target.value)}}},[r("option",{attrs:{value:"",selected:""}},[t._v("\n      "+t._s(t.$t("select"))+"\n    ")]),t._v(" "),t._l(t.items,(function(e){return r("option",{key:e,domProps:{value:e,selected:e==t.value?"selected":""}},[t._v("\n      "+t._s(e)+"\n    ")])}))],2)])}),[],!1,null,null,null);e.a=component.exports},311:function(t,e,r){"use strict";var n={name:"SubmitButton"},l=r(12),component=Object(l.a)(n,(function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"row"},[e("b-col",{staticClass:"pb-2",attrs:{lg:"4"}},[e("b-button",{attrs:{size:"lg",variant:"success",type:"submit"}},[this._v("\n      "+this._s(this.$t("search"))+"\n    ")])],1)],1)}),[],!1,null,null,null);e.a=component.exports}}]);