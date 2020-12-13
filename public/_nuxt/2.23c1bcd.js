(window.webpackJsonp=window.webpackJsonp||[]).push([[2],{109:function(t,e,n){"use strict";n.r(e);n(11),n(30);var r=n(10),l=n(323),o=n(327),c=n(325),d={layout:"admin",middleware:"auth",head:function(){return{title:this.$t("examinations")}},components:{LabelInputText:l.a,SubmitButton:o.a,SelectBox:c.a},data:function(){return{isBusy:!1,rows:1,perPage:0,currentPage:1,filter:{title:"",status:""},statuses:[{id:0,title:"not_active"},{id:1,title:"active"}],query:{},examinations:[],sortBy:"id",sortDesc:!1,fields:[{key:"id",sortable:!0},{key:"title",sortable:!0},{key:"status",sortable:!0},{key:"actions",sortable:!1}]}},watch:{currentPage:{handler:function(t){this.fetchData()}}},mounted:function(){this.fetchData()},methods:{fetchData:function(){var t=this;return Object(r.a)(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return t.query.page=t.currentPage,t.isBusy=!0,e.next=4,t.$axios.$get("examinations",{params:t.query}).then((function(e){t.rows=e.pagination.total,t.perPage=e.pagination.per_page,t.currentPage=e.pagination.current_page,t.examinations=e.data,t.isBusy=!1}));case 4:t.$router.replace({name:"examinations",query:t.query}).catch((function(){}));case 5:case"end":return e.stop()}}),e)})))()},deleteItem:function(t,e){e.preventDefault(),alert(t)},searchFilter:function(){this.currentPage=1,this.serializeFilter(this.filter,this.query),this.fetchData()},serializeFilter:function(filter,t){for(var e in filter)t[e]=filter[e]}}},m=n(12),component=Object(m.a)(d,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("header-info",{attrs:{name:"examinations",navigation:[{name:"home",link:"dashboard"},{name:"examinations",link:"",trans:!0}]}}),t._v(" "),n("section",{staticClass:"filter content"},[n("form",{attrs:{role:"form"},on:{submit:function(e){return e.preventDefault(),t.searchFilter()}}},[n("div",{staticClass:"row"},[n("div",{staticClass:"col-2"},[n("label-input-text",{attrs:{label:t.$t("title"),type:"text",placeholder:"Enter Name",name:"title"},model:{value:t.filter.title,callback:function(e){t.$set(t.filter,"title",e)},expression:"filter.title"}})],1),t._v(" "),n("div",{staticClass:"col-2"},[n("select-box",{attrs:{label:t.$t("status"),items:t.statuses,name:"examination_id"},model:{value:t.filter.status,callback:function(e){t.$set(t.filter,"status",e)},expression:"filter.status"}})],1)]),t._v(" "),n("submit-button")],1)]),t._v(" "),n("section",{staticClass:"content"},[n("div",{staticClass:"container-fluid"},[n("div",{staticClass:"row"},[n("div",{staticClass:"col-sm-12"},[n("div",{staticClass:"card card-primary"},[n("div",{staticClass:"card-header"},[n("n-link",{attrs:{to:{name:"create-examination"}}},[n("button",{staticClass:"btn btn-outline-light float-left"},[t._v("\n                  "+t._s(t.$t("add_new"))+"\n                ")])])],1),t._v(" "),n("div",{staticClass:"card card-body"},[n("b-table",{attrs:{items:t.examinations,busy:t.isBusy,fields:t.fields,"sort-by":t.sortBy,"sort-desc":t.sortDesc,"per-page":"0","current-page":t.currentPage,responsive:"sm",hover:"",striped:"","show-empty":"",stacked:"md"},on:{"update:busy":function(e){t.isBusy=e},"update:sortBy":function(e){t.sortBy=e},"update:sort-by":function(e){t.sortBy=e},"update:sortDesc":function(e){t.sortDesc=e},"update:sort-desc":function(e){t.sortDesc=e}},scopedSlots:t._u([{key:"table-busy",fn:function(){return[n("div",{staticClass:"text-center text-primary my-2"},[n("b-spinner",{staticClass:"align-middle",attrs:{variant:"primary"}}),t._v(" "),n("strong",[t._v("...تحميل")])],1)]},proxy:!0},{key:"cell(service_provider_type)",fn:function(data){return[t._v("\n                  "+t._s(data.item.service_provider_type.title)+"\n                ")]}},{key:"cell(examination)",fn:function(data){return[n("span",[t._v(t._s(data.item.examination.title))])]}},{key:"cell(parent)",fn:function(data){return[data.item.parent?n("span",[t._v(t._s(data.item.parent.title))]):t._e()]}},{key:"cell(status)",fn:function(data){return[data.item.status?n("b-badge",{attrs:{variant:"success"}},[t._v("\n                    "+t._s(t.$t("activated"))+"\n                  ")]):n("b-badge",{attrs:{variant:"danger"}},[t._v("\n                    "+t._s(t.$t("not_activated"))+"\n                  ")])]}},{key:"cell(actions)",fn:function(data){return[n("b-button",{attrs:{to:{name:"show-examination",params:{id:data.item.id}},variant:"info",size:"sm"}},[t._v("\n                    Show\n                  ")]),t._v(" "),n("b-button",{attrs:{to:{name:"edit-examination",params:{id:data.item.id}},variant:"secondary",size:"sm"}},[t._v("\n                    Edit\n                  ")]),t._v(" "),n("b-button",{attrs:{variant:"danger",size:"sm"},on:{click:function(e){return e.stopPropagation(),e.preventDefault(),t.deleteItem(data.item.id,e)}}},[t._v("\n                    Delete\n                  ")])]}}])})],1)]),t._v(" "),n("b-pagination",{attrs:{"total-rows":t.rows,"per-page":t.perPage},model:{value:t.currentPage,callback:function(e){t.currentPage=e},expression:"currentPage"}})],1)])])])],1)}),[],!1,null,null,null);e.default=component.exports},322:function(t,e,n){},323:function(t,e,n){"use strict";n(11),n(9);var r={name:"LabelInputText",props:{label:{required:!1,default:"",type:String},value:{required:!1,type:[String,Number],default:""},type:{required:!0,default:"text",type:String},placeholder:{required:!1,default:"",type:String},name:{required:!0,type:String},required:{required:!1,default:!1,type:Boolean},disabled:{required:!1,default:!1,type:Boolean}},computed:{idName:function(){return this.label.toLowerCase().replace(" ","-")+"-"+Math.floor(100*Math.random())}},methods:{updateValue:function(t){this.$emit("input",t)}}},l=n(12),component=Object(l.a)(r,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"form-group"},[t.label?n("label",{staticClass:"col-form-label",attrs:{for:t.idName}},[t._v(t._s(t.label))]):t._e(),t._v(" "),n("div",{staticClass:"input-group mb-3"},[n("input",{staticClass:"form-control",attrs:{id:t.idName,name:t.name,type:t.type,placeholder:t.placeholder,required:t.required,disabled:t.disabled},domProps:{value:t.value},on:{input:function(e){return t.updateValue(e.target.value)}}})])])}),[],!1,null,null,null);e.a=component.exports},324:function(t,e,n){"use strict";var r=n(322);n.n(r).a},325:function(t,e,n){"use strict";n(11),n(9);var r={name:"Selectbox",props:{label:{required:!1,default:"",type:String},items:{required:!0,type:[Array]},value:{required:!1,type:[String,Number],default:null},name:{required:!0,type:String}},computed:{idName:function(){return this.label.toLowerCase().replace(" ","-")+"-"+Math.floor(100*Math.random())}},methods:{updateValue:function(t){this.$emit("input",t)}}},l=(n(324),n(12)),component=Object(l.a)(r,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"form-group"},[t.label?n("label",{attrs:{for:t.idName}},[t._v(t._s(t.label))]):t._e(),t._v(" "),"object"==typeof t.items[0]?n("select",{staticClass:"form-control",attrs:{id:t.idName,name:t.name},domProps:{value:t.value},on:{input:function(e){return t.updateValue(e.target.value)}}},[n("option",{attrs:{value:"",selected:""}},[t._v("\n      "+t._s(t.$t("select"))+"\n    ")]),t._v(" "),t._l(t.items,(function(e){return n("option",{key:e.id,domProps:{value:e.id,selected:e.id==t.value?"selected":""}},[t._v("\n      "+t._s(e.title)+"\n    ")])}))],2):n("select",{staticClass:"form-control",attrs:{id:t.idName,name:t.name},domProps:{value:t.value},on:{input:function(e){return t.updateValue(e.target.value)}}},[n("option",{attrs:{value:"",selected:""}},[t._v("\n      "+t._s(t.$t("select"))+"\n    ")]),t._v(" "),t._l(t.items,(function(e){return n("option",{key:e,domProps:{value:e,selected:e==t.value?"selected":""}},[t._v("\n      "+t._s(e)+"\n    ")])}))],2)])}),[],!1,null,null,null);e.a=component.exports},327:function(t,e,n){"use strict";var r={name:"SubmitButton"},l=n(12),component=Object(l.a)(r,(function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"row"},[e("b-col",{staticClass:"pb-2",attrs:{lg:"4"}},[e("b-button",{attrs:{size:"lg",variant:"success",type:"submit"}},[this._v("\n      "+this._s(this.$t("search"))+"\n    ")])],1)],1)}),[],!1,null,null,null);e.a=component.exports}}]);