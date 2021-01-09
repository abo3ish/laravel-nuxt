(window.webpackJsonp=window.webpackJsonp||[]).push([[16],{212:function(e,t,r){"use strict";r.r(t);r(30);var n=r(10),l=r(47),o=r.n(l),c=r(324),d=r(342),m=r(326),f={layout:"admin",middleware:"auth",head:function(){return{title:this.$t("create_drug")}},components:{LabelInputText:c.a,LabelTextArea:d.a,SelectBox:m.a},data:function(){return{categories:[],drug:{},form:new o.a({id:"",name:"",scientific_name:"",image:"",description:"",category_id:"",price:""})}},created:function(){this.fetchCategories()},methods:{createDrug:function(){var e=this;this.form.post("/drugs",this.form).then((function(t){e.form.reset(),e.$notify({group:"feedback",title:e.$t("saved_successfully"),type:"success"})})).catch((function(t){e.$notify({group:"feedback",title:e.$t("saved_failed"),type:"error"})}))},fetchCategories:function(){var e=this;return Object(n.a)(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,e.$axios.$get("/pharmacy-categories").then((function(t){e.categories=t}));case 2:case"end":return t.stop()}}),t)})))()},onFileChange:function(e){var t=e.target.files[0];this.createBase64Image(t)},createBase64Image:function(e){var t=this,r=new FileReader;r.readAsDataURL(e),r.onload=function(e){t.form.image=r.result}}}},v=(r(346),r(12)),component=Object(v.a)(f,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("header-info",{attrs:{name:"drugs",navigation:[{name:"home",link:"dashboard"},{name:"drugs",link:"drugs"},{name:e.form.name,link:"",trans:!1}]}}),e._v(" "),r("div",{staticClass:"row"},[r("div",{staticClass:"col-md-12"},[r("div",{staticClass:"card card-primary"},[r("div",{staticClass:"card-header"},[r("div",{staticClass:"card-header"},[r("h3",{staticClass:"card-title"},[e._v("\n              "+e._s(e.$t("add_new"))+"\n            ")])])]),e._v(" "),r("form",{attrs:{role:"form"},on:{submit:function(t){return t.preventDefault(),e.createDrug()}}},[r("div",{staticClass:"card-body"},[r("label-input-text",{attrs:{label:e.$t("name"),type:"text",placeholder:"Enter Name",name:"name"},model:{value:e.form.name,callback:function(t){e.$set(e.form,"name",t)},expression:"form.name"}}),e._v(" "),r("label-input-text",{attrs:{label:e.$t("scientific_name"),type:"text",placeholder:"Enter Scientific Name",name:"scientific_name"},model:{value:e.form.scientific_name,callback:function(t){e.$set(e.form,"scientific_name",t)},expression:"form.scientific_name"}}),e._v(" "),r("label-input-text",{attrs:{label:e.$t("price"),type:"text",placeholder:"Enter price",name:"price"},model:{value:e.form.price,callback:function(t){e.$set(e.form,"price",t)},expression:"form.price"}}),e._v(" "),r("label-text-area",{attrs:{label:e.$t("description"),placeholder:"Enter description",name:"name"},model:{value:e.form.description,callback:function(t){e.$set(e.form,"description",t)},expression:"form.description"}}),e._v(" "),r("select-box",{attrs:{label:e.$t("category"),items:e.categories,name:"category_id"},model:{value:e.form.category_id,callback:function(t){e.$set(e.form,"category_id",t)},expression:"form.category_id"}}),e._v(" "),r("div",{staticClass:"img-responsive"},[r("input",{attrs:{type:"file",name:"icon",accept:"image/*"},on:{change:e.onFileChange}}),e._v(" "),r("img",{staticClass:"img-fluid",attrs:{src:e.form.image}})]),e._v(" "),r("div",{staticClass:"card-footer"},[r("v-button",{attrs:{loading:e.form.busy,type:"success"}},[e._v("\n                "+e._s(e.$t("save"))+"\n              ")])],1)],1)])])])])],1)}),[],!1,null,null,null);t.default=component.exports},323:function(e,t,r){},324:function(e,t,r){"use strict";r(11),r(9);var n={name:"LabelInputText",props:{label:{required:!1,default:"",type:String},value:{required:!1,type:[String,Number],default:""},type:{required:!0,default:"text",type:String},placeholder:{required:!1,default:"",type:String},name:{required:!0,type:String},required:{required:!1,default:!1,type:Boolean},disabled:{required:!1,default:!1,type:Boolean}},computed:{idName:function(){return this.label.toLowerCase().replace(" ","-")+"-"+Math.floor(100*Math.random())}},methods:{updateValue:function(e){this.$emit("input",e)}}},l=r(12),component=Object(l.a)(n,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"form-group"},[e.label?r("label",{staticClass:"col-form-label",attrs:{for:e.idName}},[e._v(e._s(e.label))]):e._e(),e._v(" "),r("div",{staticClass:"input-group mb-3"},[r("input",{staticClass:"form-control",attrs:{id:e.idName,name:e.name,type:e.type,placeholder:e.placeholder,required:e.required,disabled:e.disabled},domProps:{value:e.value},on:{input:function(t){return e.updateValue(t.target.value)}}})])])}),[],!1,null,null,null);t.a=component.exports},325:function(e,t,r){"use strict";var n=r(323);r.n(n).a},326:function(e,t,r){"use strict";r(11),r(9);var n={name:"Selectbox",props:{label:{required:!1,default:"",type:String},items:{required:!0,type:[Array]},value:{required:!1,type:[String,Number],default:null},name:{required:!0,type:String}},computed:{idName:function(){return this.label.toLowerCase().replace(" ","-")+"-"+Math.floor(100*Math.random())}},methods:{updateValue:function(e){this.$emit("input",e)}}},l=(r(325),r(12)),component=Object(l.a)(n,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"form-group"},[e.label?r("label",{attrs:{for:e.idName}},[e._v(e._s(e.label))]):e._e(),e._v(" "),"object"==typeof e.items[0]?r("select",{staticClass:"form-control",attrs:{id:e.idName,name:e.name},domProps:{value:e.value},on:{input:function(t){return e.updateValue(t.target.value)}}},[r("option",{attrs:{value:"",selected:""}},[e._v("\n      "+e._s(e.$t("select"))+"\n    ")]),e._v(" "),e._l(e.items,(function(t){return r("option",{key:t.id,domProps:{value:t.id,selected:t.id==e.value?"selected":""}},[e._v("\n      "+e._s(t.title)+"\n    ")])}))],2):r("select",{staticClass:"form-control",attrs:{id:e.idName,name:e.name},domProps:{value:e.value},on:{input:function(t){return e.updateValue(t.target.value)}}},[r("option",{attrs:{value:"",selected:""}},[e._v("\n      "+e._s(e.$t("select"))+"\n    ")]),e._v(" "),e._l(e.items,(function(t){return r("option",{key:t,domProps:{value:t,selected:t==e.value?"selected":""}},[e._v("\n      "+e._s(t)+"\n    ")])}))],2)])}),[],!1,null,null,null);t.a=component.exports},332:function(e,t,r){},342:function(e,t,r){"use strict";r(11),r(9);var n={name:"LabelInputText",props:{label:{required:!1,default:"",type:String},value:{required:!1,type:[String,Number],default:""},placeholder:{required:!1,default:"",type:String},name:{required:!0,type:String}},computed:{idName:function(){return this.label.toLowerCase().replace(" ","-")+"-"+Math.floor(100*Math.random())}},methods:{updateValue:function(e){this.$emit("input",e)}}},l=r(12),component=Object(l.a)(n,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"form-group"},[e.label?r("label",{staticClass:"col-form-label",attrs:{for:e.idName}},[e._v(e._s(e.label))]):e._e(),e._v(" "),r("div",{staticClass:"input-group mb-3"},[r("textarea",{staticClass:"form-control",attrs:{id:e.idName,name:e.name,placeholder:e.placeholder},domProps:{value:e.value},on:{input:function(t){return e.updateValue(t.target.value)}}})])])}),[],!1,null,null,null);t.a=component.exports},346:function(e,t,r){"use strict";var n=r(332);r.n(n).a}}]);