(window.webpackJsonp=window.webpackJsonp||[]).push([[1],{110:function(e,t,r){"use strict";r.r(t);r(191),r(11),r(29);var n=r(10),o=r(330),c=r(334),l=r(332),d=r(63),f={layout:"admin",middleware:"auth",head:function(){return{title:this.$t("drugs")}},components:{LabelInputText:o.a,SubmitButton:c.a,SelectBox:l.a},data:function(){return{drugs:[],categories:[],isBusy:!1,rows:1,perPage:0,currentPage:1,filter:{name:"",scientific_name:"",category_id:"",price:""},query:{},sortBy:"id",sortDesc:!1,fields:[{key:"id",sortable:!0},{key:"name",sortable:!0},{key:"scientific_name",sortable:!0},{key:"category",sortable:!0},{key:"price",sortable:!0},{key:"actions",sortable:!1}]}},watch:{currentPage:{handler:function(e){this.fetchData()}}},mounted:function(){this.fetchCategories(),this.fetchData().catch((function(e){console.log(e)}))},methods:{fetchCategories:function(){var e=this;return Object(n.a)(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,e.$axios.$get("/pharmacy-categories").then((function(t){e.categories=t}));case 2:case"end":return t.stop()}}),t)})))()},fetchData:function(){var e=this;return Object(n.a)(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return e.query.page=e.currentPage,e.isBusy=!0,t.next=4,e.$axios.$get("drugs",{params:e.query}).then((function(t){e.rows=t.pagination.total,e.perPage=t.pagination.per_page,e.currentPage=t.pagination.current_page,e.drugs=t.drugs,e.isBusy=!1}));case 4:e.$router.replace({name:"drugs",query:e.query}).catch((function(){}));case 5:case"end":return t.stop()}}),t)})))()},deleteAction:function(e,t){var r=this;return Object(n.a)(regeneratorRuntime.mark((function n(){var o,c;return regeneratorRuntime.wrap((function(n){for(;;)switch(n.prev=n.next){case 0:return o="drugs/".concat(e,"/delete"),n.next=3,Object(d.b)(o);case 3:!0===n.sent&&(c=r.drugs.findIndex((function(element){return element.id===e})),r.drugs.splice(c,1)),t.preventDefault();case 6:case"end":return n.stop()}}),n)})))()},searchFilter:function(){this.currentPage=1,this.serializeFilter(this.filter,this.query),this.fetchData()},serializeFilter:function(filter,e){for(var t in filter)e[t]=filter[t]}}},m=r(12),component=Object(m.a)(f,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("header-info",{attrs:{name:"drugs",navigation:[{name:"home",link:"dashboard"},{name:"drugs",link:""}]}}),e._v(" "),r("section",{staticClass:"filter content"},[r("form",{attrs:{role:"form"},on:{submit:function(t){return t.preventDefault(),e.searchFilter()}}},[r("div",{staticClass:"row"},[r("div",{staticClass:"col-2"},[r("label-input-text",{attrs:{label:e.$t("name"),type:"text",placeholder:"Enter Name",name:"name"},model:{value:e.filter.name,callback:function(t){e.$set(e.filter,"name",t)},expression:"filter.name"}})],1),e._v(" "),r("div",{staticClass:"col-2"},[r("label-input-text",{attrs:{label:e.$t("scientific_name"),type:"text",placeholder:"Enter Scientific Name",name:"scientific_name"},model:{value:e.filter.scientific_name,callback:function(t){e.$set(e.filter,"scientific_name",t)},expression:"filter.scientific_name"}})],1),e._v(" "),r("div",{staticClass:"col-2"},[r("select-box",{attrs:{label:e.$t("category"),items:e.categories,name:"category_id"},model:{value:e.filter.category_id,callback:function(t){e.$set(e.filter,"category_id",t)},expression:"filter.category_id"}})],1),e._v(" "),r("div",{staticClass:"col-2"},[r("label-input-text",{attrs:{label:e.$t("price"),type:"number",placeholder:"Enter Price",name:"name"},model:{value:e.filter.price,callback:function(t){e.$set(e.filter,"price",t)},expression:"filter.price"}})],1)]),e._v(" "),r("submit-button")],1)]),e._v(" "),r("section",{staticClass:"content"},[r("div",{staticClass:"container-fluid"},[r("div",{staticClass:"row"},[r("div",{staticClass:"col-sm-12"},[r("div",{staticClass:"card card-primary"},[r("div",{staticClass:"card-header"},[r("n-link",{attrs:{to:{name:"create-drug"}}},[r("button",{staticClass:"btn btn-outline-light float-left"},[e._v("\n                  "+e._s(e.$t("add_new"))+"\n                ")])])],1),e._v(" "),r("div",{staticClass:"card card-body"},[r("b-table",{attrs:{items:e.drugs,busy:e.isBusy,fields:e.fields,"sort-by":e.sortBy,"sort-desc":e.sortDesc,"per-page":"0","current-page":e.currentPage,responsive:"sm",hover:"",striped:"","show-empty":"",stacked:"md"},on:{"update:busy":function(t){e.isBusy=t},"update:sortBy":function(t){e.sortBy=t},"update:sort-by":function(t){e.sortBy=t},"update:sortDesc":function(t){e.sortDesc=t},"update:sort-desc":function(t){e.sortDesc=t}},scopedSlots:e._u([{key:"table-busy",fn:function(){return[r("div",{staticClass:"text-center text-primary my-2"},[r("b-spinner",{staticClass:"align-middle",attrs:{variant:"primary"}}),e._v(" "),r("strong",[e._v("...تحميل")])],1)]},proxy:!0},{key:"cell(category)",fn:function(data){return[r("span",[e._v(e._s(data.item.category.title))])]}},{key:"cell(actions)",fn:function(data){return[r("b-button",{attrs:{to:{name:"show-drug",params:{id:data.item.id}},variant:"info",size:"sm"}},[e._v("\n                    Show\n                  ")]),e._v(" "),r("b-button",{attrs:{to:{name:"edit-drug",params:{id:data.item.id}},variant:"secondary",size:"sm"}},[e._v("\n                    Edit\n                  ")]),e._v(" "),r("b-button",{attrs:{variant:"danger",size:"sm"},on:{click:function(t){return t.stopPropagation(),t.preventDefault(),e.deleteAction(data.item.id,t)}}},[e._v("\n                    Delete\n                  ")])]}}])})],1)]),e._v(" "),r("b-pagination",{attrs:{"total-rows":e.rows,"per-page":e.perPage},model:{value:e.currentPage,callback:function(t){e.currentPage=t},expression:"currentPage"}})],1)])])]),e._v(" "),e._m(0)],1)}),[function(){var e=this.$createElement,t=this._self._c||e;return t("div",{staticClass:"card card-primary"},[t("div",{staticClass:"card-header"})])}],!1,null,null,null);t.default=component.exports},329:function(e,t,r){},330:function(e,t,r){"use strict";r(11),r(9);var n={name:"LabelInputText",props:{label:{required:!1,default:"",type:String},value:{required:!1,type:[String,Number],default:""},type:{required:!0,default:"text",type:String},placeholder:{required:!1,default:"",type:String},name:{required:!0,type:String},required:{required:!1,default:!1,type:Boolean},disabled:{required:!1,default:!1,type:Boolean}},computed:{idName:function(){return this.label.toLowerCase().replace(" ","-")+"-"+Math.floor(100*Math.random())}},methods:{updateValue:function(e){this.$emit("input",e)}}},o=r(12),component=Object(o.a)(n,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"form-group"},[e.label?r("label",{staticClass:"col-form-label",attrs:{for:e.idName}},[e._v(e._s(e.label))]):e._e(),e._v(" "),r("div",{staticClass:"input-group mb-3"},[r("input",{staticClass:"form-control",attrs:{id:e.idName,name:e.name,type:e.type,placeholder:e.placeholder,required:e.required,disabled:e.disabled},domProps:{value:e.value},on:{input:function(t){return e.updateValue(t.target.value)}}})])])}),[],!1,null,null,null);t.a=component.exports},331:function(e,t,r){"use strict";var n=r(329);r.n(n).a},332:function(e,t,r){"use strict";r(11),r(9);var n={name:"Selectbox",props:{label:{required:!1,default:"",type:String},items:{required:!0,type:[Array]},value:{required:!1,type:[String,Number],default:null},name:{required:!0,type:String}},computed:{idName:function(){return this.label.toLowerCase().replace(" ","-")+"-"+Math.floor(100*Math.random())}},methods:{updateValue:function(e){this.$emit("input",e)}}},o=(r(331),r(12)),component=Object(o.a)(n,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"form-group"},[e.label?r("label",{attrs:{for:e.idName}},[e._v(e._s(e.label))]):e._e(),e._v(" "),"object"==typeof e.items[0]?r("select",{staticClass:"form-control",attrs:{id:e.idName,name:e.name},domProps:{value:e.value},on:{input:function(t){return e.updateValue(t.target.value)}}},[r("option",{attrs:{value:"",selected:""}},[e._v("\n      "+e._s(e.$t("select"))+"\n    ")]),e._v(" "),e._l(e.items,(function(t){return r("option",{key:t.id,domProps:{value:t.id,selected:t.id==e.value?"selected":""}},[e._v("\n      "+e._s(t.title)+"\n    ")])}))],2):r("select",{staticClass:"form-control",attrs:{id:e.idName,name:e.name},domProps:{value:e.value},on:{input:function(t){return e.updateValue(t.target.value)}}},[r("option",{attrs:{value:"",selected:""}},[e._v("\n      "+e._s(e.$t("select"))+"\n    ")]),e._v(" "),e._l(e.items,(function(t){return r("option",{key:t,domProps:{value:t,selected:t==e.value?"selected":""}},[e._v("\n      "+e._s(t)+"\n    ")])}))],2)])}),[],!1,null,null,null);t.a=component.exports},334:function(e,t,r){"use strict";var n={name:"SubmitButton"},o=r(12),component=Object(o.a)(n,(function(){var e=this.$createElement,t=this._self._c||e;return t("div",{staticClass:"row"},[t("b-col",{staticClass:"pb-2",attrs:{lg:"4"}},[t("b-button",{attrs:{size:"lg",variant:"success",type:"submit"}},[this._v("\n      "+this._s(this.$t("search"))+"\n    ")])],1)],1)}),[],!1,null,null,null);t.a=component.exports}}]);