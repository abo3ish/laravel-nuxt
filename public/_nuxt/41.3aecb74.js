(window.webpackJsonp=window.webpackJsonp||[]).push([[41],{216:function(e,t,r){"use strict";r.r(t);r(103),r(30);var n=r(10),l=r(47),o=r.n(l),c=r(323),d=r(326),m={layout:"admin",middleware:"auth",head:function(){return{title:this.form.title}},components:{LabelInputText:c.a,CheckBox:d.a},data:function(){return{image:null,form:new o.a({title:"",description:"",display_order:"",icon:"",slug:"",accept_multi:Boolean(!0),status:Boolean(!0)})}},mounted:function(){this.fetchData()},methods:{fetchData:function(){var e=this;return Object(n.a)(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,e.$axios.$get("/examinations/"+e.$route.params.id).then((function(t){e.form.fill(t)}));case 2:case"end":return t.stop()}}),t)})))()},update:function(){var e=this;this.form.put("/examinations/"+this.$route.params.id,this.form).then((function(t){200===t.status?(e.$notify({group:"feedback",title:e.$t("saved_successfully"),type:"success"}),e.form.fill(t.data)):e.$notify({group:"feedback",title:e.$t("saved_failed"),type:"error"})})).catch((function(){e.$notify({group:"feedback",title:e.$t("saved_failed"),type:"error"})})),this.form.reset()},onFileChange:function(e){var t=e.target.files[0];this.createBase64Image(t)},createBase64Image:function(e){var t=this,r=new FileReader;r.onload=function(e){t.form.icon=r.result},r.readAsDataURL(e)}}},f=r(12),component=Object(f.a)(m,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[e.form.title?e._e():r("loading"),e._v(" "),r("header-info",{attrs:{name:"examinations",navigation:[{name:"home",link:"dashboard"},{name:"examinations",link:"examinations"},{name:e.form.title,link:"",trans:!1}]}}),e._v(" "),r("div",{staticClass:"row"},[r("div",{staticClass:"col-md-12"},[r("div",{staticClass:"card card-primary"},[r("div",{staticClass:"card-header"},[r("h3",{staticClass:"card-title"},[e._v("\n            "+e._s(e.$t("edit")+" "+e.$t("examination"))+"\n          ")])]),e._v(" "),r("form",{attrs:{role:"form"},on:{submit:function(t){return t.preventDefault(),e.update()}}},[r("div",{staticClass:"card-body"},[r("label-input-text",{attrs:{label:e.$t("title"),type:"text",placeholder:"Enter Title",name:"title"},model:{value:e.form.title,callback:function(t){e.$set(e.form,"title",t)},expression:"form.title"}}),e._v(" "),r("label-input-text",{attrs:{label:e.$t("description"),type:"text",placeholder:"Enter Description",name:"description"},model:{value:e.form.description,callback:function(t){e.$set(e.form,"description",t)},expression:"form.description"}}),e._v(" "),r("label-input-text",{attrs:{label:e.$t("display_order"),type:"number",placeholder:"Enter Price",name:"display_order"},model:{value:e.form.display_order,callback:function(t){e.$set(e.form,"display_order",t)},expression:"form.display_order"}}),e._v(" "),r("label-input-text",{attrs:{label:e.$t("slug"),type:"text",placeholder:"Enter Slug",name:"slug"},model:{value:e.form.slug,callback:function(t){e.$set(e.form,"slug",t)},expression:"form.slug"}}),e._v(" "),r("check-box",{attrs:{label:e.$t("accept_multi"),name:"accept_multi"},model:{value:e.form.accept_multi,callback:function(t){e.$set(e.form,"accept_multi",t)},expression:"form.accept_multi"}}),e._v(" "),r("check-box",{attrs:{label:e.$t("activate"),name:"status"},model:{value:e.form.status,callback:function(t){e.$set(e.form,"status",t)},expression:"form.status"}}),e._v(" "),r("div",{staticClass:"img-responsive"},[r("input",{attrs:{type:"file",name:"icon",accept:"image/*"},on:{change:e.onFileChange}}),e._v(" "),r("img",{staticClass:"img-fluid",attrs:{src:e.form.icon}})]),e._v(" "),r("div",{staticClass:"card-footer"},[r("v-button",{attrs:{loading:e.form.busy,type:"success"}},[e._v("\n                "+e._s(e.$t("save"))+"\n              ")])],1)],1)])])])])],1)}),[],!1,null,null,null);t.default=component.exports},323:function(e,t,r){"use strict";r(11),r(9);var n={name:"LabelInputText",props:{label:{required:!1,default:"",type:String},value:{required:!1,type:[String,Number],default:""},type:{required:!0,default:"text",type:String},placeholder:{required:!1,default:"",type:String},name:{required:!0,type:String},required:{required:!1,default:!1,type:Boolean},disabled:{required:!1,default:!1,type:Boolean}},computed:{idName:function(){return this.label.toLowerCase().replace(" ","-")+"-"+Math.floor(100*Math.random())}},methods:{updateValue:function(e){this.$emit("input",e)}}},l=r(12),component=Object(l.a)(n,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"form-group"},[e.label?r("label",{staticClass:"col-form-label",attrs:{for:e.idName}},[e._v(e._s(e.label))]):e._e(),e._v(" "),r("div",{staticClass:"input-group mb-3"},[r("input",{staticClass:"form-control",attrs:{id:e.idName,name:e.name,type:e.type,placeholder:e.placeholder,required:e.required,disabled:e.disabled},domProps:{value:e.value},on:{input:function(t){return e.updateValue(t.target.value)}}})])])}),[],!1,null,null,null);t.a=component.exports},326:function(e,t,r){"use strict";r(11),r(9);var n={name:"CheckBox",props:{label:{required:!1,default:"",type:String},value:{required:!0,type:[Boolean,Number],default:!1},name:{required:!0,type:String}},computed:{idName:function(){return this.label.toLowerCase().replace(" ","-")+"-"+Math.floor(100*Math.random())}},methods:{updateValue:function(e){this.$emit("input",e)}}},l=r(12),component=Object(l.a)(n,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"form-check"},[r("input",{staticClass:"form-check-input",attrs:{id:e.idName,name:e.name,type:"checkbox"},domProps:{value:e.value,checked:e.value},on:{change:function(t){return e.updateValue(t.target.checked)}}}),e._v(" "),r("label",{staticClass:"form-check-label",attrs:{for:e.idName}},[e._v(e._s(e.label))])])}),[],!1,null,null,null);t.a=component.exports}}]);