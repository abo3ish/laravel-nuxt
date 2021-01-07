(window.webpackJsonp=window.webpackJsonp||[]).push([[25],{230:function(e,t,r){"use strict";r.r(t);r(103),r(30);var n=r(10),o=r(47),l=r.n(o),c=r(323),d=r(325),m=r(326),f={layout:"admin",middleware:"auth",head:function(){return{title:this.form.title}},components:{LabelInputText:c.a,SelectBox:d.a,CheckBox:m.a},data:function(){return{loading:!1,serviceProviderTypes:[],parents:[],examinations:[],file:null,image:null,form:new l.a({title:"",description:"",display_order:"",icon:"",service_provider_type_id:"",estimation_from:"",estimation_to:"",price:"",examination_id:"",parent_id:"",status:Boolean(!0),slug:""})}},mounted:function(){this.fetchParents(),this.fetchServiceProviderTypes(),this.fetchExaminations(),this.fetchData()},methods:{fetchData:function(){var e=this;return Object(n.a)(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return e.loading=!0,t.next=3,e.$axios.$get("/services/"+e.$route.params.id).then((function(t){e.form.fill(t)}));case 3:e.loading=!1;case 4:case"end":return t.stop()}}),t)})))()},update:function(){var e=this;this.loading=!0,this.form.post("/services/"+this.$route.params.id,this.form).then((function(t){200===t.status?(e.$notify({group:"feedback",title:e.$t("service_provider_saved_successfully"),type:"success"}),e.form.fill(t.data)):e.$notify({group:"feedback",title:e.$t("service_provider_saved_failed"),type:"error"})})).catch((function(){e.$notify({group:"feedback",title:e.$t("service_provider_saved_failed"),type:"error"})})),this.loading=!1},onFileChange:function(e){var t=e.target.files[0];this.createBase64Image(t)},createBase64Image:function(e){var t=this,r=new FileReader;r.onload=function(e){t.form.icon=r.result},r.readAsDataURL(e)},fetchServiceProviderTypes:function(){var e=this;return Object(n.a)(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,e.$axios.$get("service-provider-types/all").then((function(t){e.serviceProviderTypes=t}));case 2:case"end":return t.stop()}}),t)})))()},fetchExaminations:function(){var e=this;return Object(n.a)(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,e.$axios.$get("examinations/all").then((function(t){e.examinations=t}));case 2:case"end":return t.stop()}}),t)})))()},fetchParents:function(){var e=this;return Object(n.a)(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,e.$axios.$get("services/all").then((function(t){e.parents=t}));case 2:case"end":return t.stop()}}),t)})))()}}},v=r(12),component=Object(v.a)(f,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[e.loading?r("loading"):e._e(),e._v(" "),r("header-info",{attrs:{name:"services",navigation:[{name:"home",link:"dashboard"},{name:"services",link:"services"},{name:e.form.title,link:"",trans:!1}]}}),e._v(" "),r("div",{staticClass:"row"},[r("div",{staticClass:"col-md-12"},[r("div",{staticClass:"card card-primary"},[r("div",{staticClass:"card-header"},[r("h3",{staticClass:"card-title"},[e._v("\n            "+e._s(e.$t("create_new_service"))+"\n          ")])]),e._v(" "),r("form",{attrs:{role:"form"},on:{submit:function(t){return t.preventDefault(),e.update()}}},[r("div",{staticClass:"card-body"},[r("label-input-text",{attrs:{label:e.$t("title"),type:"text",placeholder:"Enter Title",name:"title"},model:{value:e.form.title,callback:function(t){e.$set(e.form,"title",t)},expression:"form.title"}}),e._v(" "),r("label-input-text",{attrs:{label:e.$t("description"),type:"text",placeholder:"Enter Description",name:"description"},model:{value:e.form.description,callback:function(t){e.$set(e.form,"description",t)},expression:"form.description"}}),e._v(" "),r("select-box",{attrs:{items:e.serviceProviderTypes,label:e.$t("service_provider_type"),name:"service_provider_type_id"},model:{value:e.form.service_provider_type_id,callback:function(t){e.$set(e.form,"service_provider_type_id",t)},expression:"form.service_provider_type_id"}}),e._v(" "),r("select-box",{attrs:{items:e.examinations,label:e.$t("examination_type"),name:"examination_id"},model:{value:e.form.examination_id,callback:function(t){e.$set(e.form,"examination_id",t)},expression:"form.examination_id"}}),e._v(" "),r("label-input-text",{attrs:{label:e.$t("estimation_from"),type:"number",placeholder:"Enter Estimation From Price",name:"estimation_from"},model:{value:e.form.estimation_from,callback:function(t){e.$set(e.form,"estimation_from",t)},expression:"form.estimation_from"}}),e._v(" "),r("label-input-text",{attrs:{label:e.$t("estimation_to"),type:"number",placeholder:"Enter Estimation To Price",name:"estimation_to"},model:{value:e.form.estimation_to,callback:function(t){e.$set(e.form,"estimation_to",t)},expression:"form.estimation_to"}}),e._v(" "),r("label-input-text",{attrs:{label:e.$t("price"),type:"number",placeholder:"Enter Price",name:"price"},model:{value:e.form.price,callback:function(t){e.$set(e.form,"price",t)},expression:"form.price"}}),e._v(" "),r("label-input-text",{attrs:{label:e.$t("display_order"),type:"number",placeholder:"Enter Display Order",name:"display_order"},model:{value:e.form.display_order,callback:function(t){e.$set(e.form,"display_order",t)},expression:"form.display_order"}}),e._v(" "),r("select-box",{attrs:{items:e.parents,label:e.$t("parent"),name:"parent_id"},model:{value:e.form.parent_id,callback:function(t){e.$set(e.form,"parent_id",t)},expression:"form.parent_id"}}),e._v(" "),r("label-input-text",{attrs:{label:e.$t("slug"),type:"text",placeholder:"Enter Slug",name:"slug"},model:{value:e.form.slug,callback:function(t){e.$set(e.form,"slug",t)},expression:"form.slug"}}),e._v(" "),r("check-box",{attrs:{label:e.$t("activate"),name:"status"},model:{value:e.form.status,callback:function(t){e.$set(e.form,"status",t)},expression:"form.status"}}),e._v(" "),r("div",{staticClass:"img-responsive"},[r("input",{attrs:{type:"file",name:"icon",accept:"image/*"},on:{change:e.onFileChange}}),e._v(" "),r("img",{staticClass:"img-fluid",attrs:{src:e.form.icon}})]),e._v(" "),r("div",{staticClass:"card-footer"},[r("v-button",{attrs:{loading:e.form.busy,type:"success"}},[e._v("\n                "+e._s(e.$t("save"))+"\n              ")])],1)],1)])])])])],1)}),[],!1,null,null,null);t.default=component.exports},322:function(e,t,r){},323:function(e,t,r){"use strict";r(11),r(9);var n={name:"LabelInputText",props:{label:{required:!1,default:"",type:String},value:{required:!1,type:[String,Number],default:""},type:{required:!0,default:"text",type:String},placeholder:{required:!1,default:"",type:String},name:{required:!0,type:String},required:{required:!1,default:!1,type:Boolean},disabled:{required:!1,default:!1,type:Boolean}},computed:{idName:function(){return this.label.toLowerCase().replace(" ","-")+"-"+Math.floor(100*Math.random())}},methods:{updateValue:function(e){this.$emit("input",e)}}},o=r(12),component=Object(o.a)(n,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"form-group"},[e.label?r("label",{staticClass:"col-form-label",attrs:{for:e.idName}},[e._v(e._s(e.label))]):e._e(),e._v(" "),r("div",{staticClass:"input-group mb-3"},[r("input",{staticClass:"form-control",attrs:{id:e.idName,name:e.name,type:e.type,placeholder:e.placeholder,required:e.required,disabled:e.disabled},domProps:{value:e.value},on:{input:function(t){return e.updateValue(t.target.value)}}})])])}),[],!1,null,null,null);t.a=component.exports},324:function(e,t,r){"use strict";var n=r(322);r.n(n).a},325:function(e,t,r){"use strict";r(11),r(9);var n={name:"Selectbox",props:{label:{required:!1,default:"",type:String},items:{required:!0,type:[Array]},value:{required:!1,type:[String,Number],default:null},name:{required:!0,type:String}},computed:{idName:function(){return this.label.toLowerCase().replace(" ","-")+"-"+Math.floor(100*Math.random())}},methods:{updateValue:function(e){this.$emit("input",e)}}},o=(r(324),r(12)),component=Object(o.a)(n,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"form-group"},[e.label?r("label",{attrs:{for:e.idName}},[e._v(e._s(e.label))]):e._e(),e._v(" "),"object"==typeof e.items[0]?r("select",{staticClass:"form-control",attrs:{id:e.idName,name:e.name},domProps:{value:e.value},on:{input:function(t){return e.updateValue(t.target.value)}}},[r("option",{attrs:{value:"",selected:""}},[e._v("\n      "+e._s(e.$t("select"))+"\n    ")]),e._v(" "),e._l(e.items,(function(t){return r("option",{key:t.id,domProps:{value:t.id,selected:t.id==e.value?"selected":""}},[e._v("\n      "+e._s(t.title)+"\n    ")])}))],2):r("select",{staticClass:"form-control",attrs:{id:e.idName,name:e.name},domProps:{value:e.value},on:{input:function(t){return e.updateValue(t.target.value)}}},[r("option",{attrs:{value:"",selected:""}},[e._v("\n      "+e._s(e.$t("select"))+"\n    ")]),e._v(" "),e._l(e.items,(function(t){return r("option",{key:t,domProps:{value:t,selected:t==e.value?"selected":""}},[e._v("\n      "+e._s(t)+"\n    ")])}))],2)])}),[],!1,null,null,null);t.a=component.exports},326:function(e,t,r){"use strict";r(11),r(9);var n={name:"CheckBox",props:{label:{required:!1,default:"",type:String},value:{required:!0,type:[Boolean,Number],default:!1},name:{required:!0,type:String}},computed:{idName:function(){return this.label.toLowerCase().replace(" ","-")+"-"+Math.floor(100*Math.random())}},methods:{updateValue:function(e){this.$emit("input",e)}}},o=r(12),component=Object(o.a)(n,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"form-check"},[r("input",{staticClass:"form-check-input",attrs:{id:e.idName,name:e.name,type:"checkbox"},domProps:{value:e.value,checked:e.value},on:{change:function(t){return e.updateValue(t.target.checked)}}}),e._v(" "),r("label",{staticClass:"form-check-label",attrs:{for:e.idName}},[e._v(e._s(e.label))])])}),[],!1,null,null,null);t.a=component.exports}}]);