(window.webpackJsonp=window.webpackJsonp||[]).push([[18],{204:function(e,t,r){"use strict";r.r(t);r(30);var n=r(10),l=(r(102),r(13),r(47)),o=r.n(l),c=r(312),d=r(327),m=r(313),f=r(316),v={layout:"admin",middleware:"auth",head:function(){return{title:this.drug.name}},components:{LabelInputText:c.a,LabelTextArea:d.a,SelectBox:m.a,HeaderInfo:f.a},data:function(){return{categories:[],drug:{},form:new o.a({id:"",name:"",scientific_name:"",image:"",description:"",category_id:"",price:""})}},created:function(){this.fetchCategories(),this.fetchData()},methods:{fetchData:function(){var e=this;this.$axios.$get("drugs/"+this.$route.params.id+"/edit").then((function(t){e.form.fill(t),e.form.category_id=t.category.id,e.drug=t}))},updatedrug:function(){var e=this;this.form.put("/drugs/"+this.$route.params.id,this.form).then((function(t){e.form.fill(t.data),e.form.category_id=t.data.category.id,e.drug=t.data,e.$notify({group:"feedback",title:e.$t("drug_saved_sucessfully"),type:"success"})})).catch((function(t){e.$notify({group:"feedback",title:e.$t("drug_saved_failed"),type:"error"})}))},fetchCategories:function(){var e=this;return Object(n.a)(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,e.$axios.$get("/pharmacy-categories").then((function(t){e.categories=t}));case 2:case"end":return t.stop()}}),t)})))()},onFileChange:function(e){var t=e.target.files[0];this.createBase64Image(t)},createBase64Image:function(e){var t=this,r=new FileReader;r.readAsDataURL(e),r.onload=function(e){t.form.image=r.result}}}},_=r(12),component=Object(_.a)(v,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("header-info",{attrs:{name:"drugs",navigation:[{name:"home",link:"dashboard"},{name:"drugs",link:"drugs"},{name:e.drug.name,link:"",trans:!1}]}}),e._v(" "),r("div",{staticClass:"row"},[r("div",{staticClass:"col-md-12"},[r("div",{staticClass:"card card-primary"},[r("div",{staticClass:"card-header"},[r("h3",{staticClass:"card-title"},[e._v("\n            "+e._s(e.drug.name)+"\n            "),r("n-link",{attrs:{to:{name:"create-drug"}}},[r("button",{staticClass:"btn btn-outline-light float-left"},[e._v("\n                "+e._s(e.$t("add_new"))+"\n              ")])]),e._v(" "),r("n-link",{attrs:{to:{name:"show-drug"}}},[r("button",{staticClass:"btn btn-outline-light float-left"},[e._v("\n                "+e._s(e.$t("show"))+"\n              ")])])],1)]),e._v(" "),r("form",{attrs:{role:"form"},on:{submit:function(t){return t.preventDefault(),e.updatedrug()}}},[r("div",{staticClass:"card-body"},[r("label-input-text",{attrs:{label:e.$t("name"),type:"text",placeholder:"Enter Name",name:"name"},model:{value:e.form.name,callback:function(t){e.$set(e.form,"name",t)},expression:"form.name"}}),e._v(" "),r("label-input-text",{attrs:{label:e.$t("scientific_name"),type:"text",placeholder:"Enter Scientific Name",name:"scientific_name"},model:{value:e.form.scientific_name,callback:function(t){e.$set(e.form,"scientific_name",t)},expression:"form.scientific_name"}}),e._v(" "),r("label-input-text",{attrs:{label:e.$t("price"),type:"text",placeholder:"Enter price",name:"price"},model:{value:e.form.price,callback:function(t){e.$set(e.form,"price",t)},expression:"form.price"}}),e._v(" "),r("label-text-area",{attrs:{label:e.$t("description"),placeholder:"Enter description",name:"name"},model:{value:e.form.description,callback:function(t){e.$set(e.form,"description",t)},expression:"form.description"}}),e._v(" "),r("select-box",{attrs:{label:e.$t("category"),items:e.categories,name:"category_id"},model:{value:e.form.category_id,callback:function(t){e.$set(e.form,"category_id",t)},expression:"form.category_id"}}),e._v(" "),r("div",{staticClass:"img-responsive"},[r("input",{attrs:{type:"file",name:"icon",accept:"image/*"},on:{change:e.onFileChange}}),e._v(" "),r("img",{staticClass:"img-fluid",attrs:{src:e.form.image}})]),e._v(" "),r("div",{staticClass:"card-footer"},[r("v-button",{attrs:{loading:e.form.busy,type:"success"}},[e._v("\n                "+e._s(e.$t("save"))+"\n              ")])],1)],1)])])])])],1)}),[],!1,null,null,null);t.default=component.exports},312:function(e,t,r){"use strict";r(11),r(9);var n={name:"LabelInputText",props:{label:{required:!1,default:"",type:String},value:{required:!1,type:[String,Number],default:""},type:{required:!0,default:"text",type:String},placeholder:{required:!1,default:"",type:String},name:{required:!0,type:String}},computed:{idName:function(){return this.label.toLowerCase().replace(" ","-")+"-"+Math.floor(100*Math.random())}},methods:{updateValue:function(e){this.$emit("input",e)}}},l=r(12),component=Object(l.a)(n,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"form-group"},[e.label?r("label",{staticClass:"col-form-label",attrs:{for:e.idName}},[e._v(e._s(e.label))]):e._e(),e._v(" "),r("div",{staticClass:"input-group mb-3"},[r("input",{staticClass:"form-control",attrs:{id:e.idName,name:e.name,type:e.type,placeholder:e.placeholder},domProps:{value:e.value},on:{input:function(t){return e.updateValue(t.target.value)}}})])])}),[],!1,null,null,null);t.a=component.exports},313:function(e,t,r){"use strict";r(11),r(9);var n={name:"Selectbox",props:{label:{required:!1,default:"",type:String},items:{required:!0,type:[Array]},value:{required:!1,type:[String,Number],default:null},name:{required:!0,type:String}},computed:{idName:function(){return this.label.toLowerCase().replace(" ","-")+"-"+Math.floor(100*Math.random())}},methods:{updateValue:function(e){this.$emit("input",e)}}},l=r(12),component=Object(l.a)(n,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"form-group"},[e.label?r("label",{attrs:{for:e.idName}},[e._v(e._s(e.label))]):e._e(),e._v(" "),"object"==typeof e.items[0]?r("select",{staticClass:"form-control",attrs:{id:e.idName,name:e.name},domProps:{value:e.value},on:{input:function(t){return e.updateValue(t.target.value)}}},[r("option",{attrs:{value:"",selected:""}},[e._v("\n      "+e._s(e.$t("select"))+"\n    ")]),e._v(" "),e._l(e.items,(function(t){return r("option",{key:t.id,domProps:{value:t.id,selected:t.id==e.value?"selected":""}},[e._v("\n      "+e._s(t.title)+"\n    ")])}))],2):r("select",{staticClass:"form-control",attrs:{id:e.idName,name:e.name},domProps:{value:e.value},on:{input:function(t){return e.updateValue(t.target.value)}}},[r("option",{attrs:{value:"",selected:""}},[e._v("\n      "+e._s(e.$t("select"))+"\n    ")]),e._v(" "),e._l(e.items,(function(t){return r("option",{key:t,domProps:{value:t,selected:t==e.value?"selected":""}},[e._v("\n      "+e._s(t)+"\n    ")])}))],2)])}),[],!1,null,null,null);t.a=component.exports},316:function(e,t,r){"use strict";var n={name:"HeaderInfo",props:{name:{required:!1,default:"",type:String},navigation:{required:!1,default:"",type:[Array,String]}}},l=r(12),component=Object(l.a)(n,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("section",{staticClass:"content-header"},[r("div",{staticClass:"container-fluid"},[r("div",{staticClass:"row mb-2"},[r("div",{staticClass:"col-sm-6"},[r("h1",[e._v(e._s(e.$t(e.name)))])]),e._v(" "),r("div",{staticClass:"col-sm-6"},[r("ol",{staticClass:"breadcrumb float-sm-left"},e._l(e.navigation,(function(t){return r("li",{key:t.name,staticClass:"breadcrumb-item",class:t.link?"active":""},[t.link?r("nuxt-link",{attrs:{to:{name:t.link}}},[e._v("\n              "+e._s(e.$t(t.name))+"\n            ")]):r("span",[e._v("\n              "+e._s(!1===t.trans?t.name:e.$t(t.name))+"\n            ")])],1)})),0)])])])])}),[],!1,null,null,null);t.a=component.exports},327:function(e,t,r){"use strict";r(11),r(9);var n={name:"LabelInputText",props:{label:{required:!1,default:"",type:String},value:{required:!1,type:[String,Number],default:""},placeholder:{required:!1,default:"",type:String},name:{required:!0,type:String}},computed:{idName:function(){return this.label.toLowerCase().replace(" ","-")+"-"+Math.floor(100*Math.random())}},methods:{updateValue:function(e){this.$emit("input",e)}}},l=r(12),component=Object(l.a)(n,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"form-group"},[e.label?r("label",{staticClass:"col-form-label",attrs:{for:e.idName}},[e._v(e._s(e.label))]):e._e(),e._v(" "),r("div",{staticClass:"input-group mb-3"},[r("textarea",{staticClass:"form-control",attrs:{id:e.idName,name:e.name,placeholder:e.placeholder},domProps:{value:e.value},on:{input:function(t){return e.updateValue(t.target.value)}}})])])}),[],!1,null,null,null);t.a=component.exports}}]);