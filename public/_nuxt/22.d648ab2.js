(window.webpackJsonp=window.webpackJsonp||[]).push([[22],{208:function(e,t,r){"use strict";r.r(t);r(29);var n=r(10),o=(r(103),r(47)),l=r.n(o),c=r(302),m=r(303),d=r(304),f={layout:"admin",components:{LabelInputText:c.a,SelectBox:m.a,CheckBox:d.a},data:function(){return{serviceProviderTypes:[],parents:[],examinations:[],file:null,image:null,form:new l.a({title:"",description:"",icon:"",service_provider_type_id:"",estimation_from:"",estimation_to:"",purchase_price:"",sell_price:"",examination_id:"",parent_id:"",status:Boolean(!0),slug:""})}},mounted:function(){this.fetchParents(),this.fetchServiceProviderTypes(),this.fetchExaminations(),this.fetchData()},methods:{fetchData:function(){var e=this;this.$axios.$get("/services/"+this.$route.params.id).then((function(t){e.form.fill(t)}))},update:function(){var e=this;this.form.put("/services/"+this.$route.params.id,this.form).then((function(t){200===t.status?(e.$notify({group:"feedback",title:e.$t("service_provider_saved_sucessfully"),type:"success"}),e.form.fill(t.data)):e.$notify({group:"feedback",title:e.$t("service_provider_saved_failed"),type:"error"})})).catch((function(){e.$notify({group:"feedback",title:e.$t("service_provider_saved_failed"),type:"error"})})),this.form.reset()},onFileChange:function(e){var t=e.target.files[0];this.createBase64Image(t)},createBase64Image:function(e){var t=this,r=new FileReader;r.onload=function(e){t.form.icon=r.result},r.readAsDataURL(e)},fetchServiceProviderTypes:function(){var e=this;return Object(n.a)(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,e.$axios.$get("service-provider-types/all").then((function(t){e.serviceProviderTypes=t}));case 2:case"end":return t.stop()}}),t)})))()},fetchExaminations:function(){var e=this;return Object(n.a)(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,e.$axios.$get("examinations/all").then((function(t){e.examinations=t}));case 2:case"end":return t.stop()}}),t)})))()},fetchParents:function(){var e=this;return Object(n.a)(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,e.$axios.$get("services/all").then((function(t){e.parents=t}));case 2:case"end":return t.stop()}}),t)})))()}}},v=r(11),component=Object(v.a)(f,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("section",{staticClass:"content-header"},[r("div",{staticClass:"container-fluid"},[r("div",{staticClass:"row mb-2"},[r("div",{staticClass:"col-sm-6"},[r("h1",[e._v(e._s(e.$t("services")))])]),e._v(" "),r("div",{staticClass:"col-sm-6"},[r("ol",{staticClass:"breadcrumb float-sm-left"},[r("li",{staticClass:"breadcrumb-item"},[r("nuxt-link",{attrs:{to:{name:"home"}}},[e._v("\n                "+e._s(e.$t("home"))+"\n              ")])],1),e._v(" "),r("li",{staticClass:"breadcrumb-item active"},[r("nuxt-link",{attrs:{to:{name:"services"}}},[e._v("\n                "+e._s(e.$t("services"))+"\n              ")])],1),e._v(" "),r("li",{staticClass:"breadcrumb-item active"},[e._v("\n              "+e._s(e.$t("new_service_provider"))+"\n            ")])])])])])]),e._v(" "),r("div",{staticClass:"row"},[r("div",{staticClass:"col-md-12"},[r("div",{staticClass:"card card-primary"},[r("div",{staticClass:"card-header"},[r("h3",{staticClass:"card-title"},[e._v("\n            "+e._s(e.$t("create_new_service"))+"\n          ")])]),e._v(" "),r("form",{attrs:{role:"form"},on:{submit:function(t){return t.preventDefault(),e.update()}}},[r("div",{staticClass:"card-body"},[r("label-input-text",{attrs:{label:e.$t("title"),type:"text",placeholder:"Enter Title",name:"title"},model:{value:e.form.title,callback:function(t){e.$set(e.form,"title",t)},expression:"form.title"}}),e._v(" "),r("label-input-text",{attrs:{label:e.$t("description"),type:"text",placeholder:"Enter Description",name:"description"},model:{value:e.form.description,callback:function(t){e.$set(e.form,"description",t)},expression:"form.description"}}),e._v(" "),r("select-box",{attrs:{items:e.serviceProviderTypes,label:e.$t("service_provider_type"),name:"service_provider_type_id"},model:{value:e.form.service_provider_type_id,callback:function(t){e.$set(e.form,"service_provider_type_id",t)},expression:"form.service_provider_type_id"}}),e._v(" "),r("select-box",{attrs:{items:e.examinations,label:e.$t("examination_type"),name:"examination_id"},model:{value:e.form.examination_id,callback:function(t){e.$set(e.form,"examination_id",t)},expression:"form.examination_id"}}),e._v(" "),r("label-input-text",{attrs:{label:e.$t("estimation_from"),type:"number",placeholder:"Enter Estimation From Price",name:"estimation_from"},model:{value:e.form.estimation_from,callback:function(t){e.$set(e.form,"estimation_from",t)},expression:"form.estimation_from"}}),e._v(" "),r("label-input-text",{attrs:{label:e.$t("estimation_to"),type:"number",placeholder:"Enter Estimation To Price",name:"estimation_to"},model:{value:e.form.estimation_to,callback:function(t){e.$set(e.form,"estimation_to",t)},expression:"form.estimation_to"}}),e._v(" "),r("label-input-text",{attrs:{label:e.$t("purchase_price"),type:"number",placeholder:"Enter purchase Price",name:"purchase_price"},model:{value:e.form.purchase_price,callback:function(t){e.$set(e.form,"purchase_price",t)},expression:"form.purchase_price"}}),e._v(" "),r("label-input-text",{attrs:{label:e.$t("sell_price"),type:"number",placeholder:"Enter sell Price",name:"sell_price"},model:{value:e.form.sell_price,callback:function(t){e.$set(e.form,"sell_price",t)},expression:"form.sell_price"}}),e._v(" "),r("select-box",{attrs:{items:e.parents,label:e.$t("parents"),name:"parent_id"},model:{value:e.form.parent_id,callback:function(t){e.$set(e.form,"parent_id",t)},expression:"form.parent_id"}}),e._v(" "),r("label-input-text",{attrs:{label:e.$t("slug"),type:"text",placeholder:"Enter Slug",name:"slug"},model:{value:e.form.slug,callback:function(t){e.$set(e.form,"slug",t)},expression:"form.slug"}}),e._v(" "),r("check-box",{attrs:{label:e.$t("activate"),name:"status"},model:{value:e.form.status,callback:function(t){e.$set(e.form,"status",t)},expression:"form.status"}}),e._v(" "),r("div",{staticClass:"img-responsive"},[r("input",{attrs:{type:"file",name:"icon",accept:"image/*"},on:{change:e.onFileChange}}),e._v(" "),r("img",{staticClass:"img-fluid",attrs:{src:e.form.icon}})]),e._v(" "),r("div",{staticClass:"card-footer"},[r("v-button",{attrs:{loading:e.form.busy,type:"success"}},[e._v("\n                "+e._s(e.$t("save"))+"\n              ")])],1)],1)])])])])])}),[],!1,null,null,null);t.default=component.exports},302:function(e,t,r){"use strict";r(12),r(9);var n={name:"LabelInputText",props:{label:{required:!1,default:"",type:String},value:{required:!1,type:[String,Number],default:""},type:{required:!0,default:"text",type:String},placeholder:{required:!1,default:"",type:String},name:{required:!0,type:String}},computed:{idName:function(){return this.label.toLowerCase().replace(" ","-")+"-"+Math.floor(100*Math.random())}},methods:{updateValue:function(e){this.$emit("input",e)}}},o=r(11),component=Object(o.a)(n,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"form-group"},[e.label?r("label",{staticClass:"col-form-label",attrs:{for:e.idName}},[e._v(e._s(e.label))]):e._e(),e._v(" "),r("div",{staticClass:"input-group mb-3"},[r("input",{staticClass:"form-control",attrs:{id:e.idName,name:e.name,type:e.type,placeholder:e.placeholder},domProps:{value:e.value},on:{input:function(t){return e.updateValue(t.target.value)}}})])])}),[],!1,null,null,null);t.a=component.exports},303:function(e,t,r){"use strict";r(12),r(9);var n={name:"Selectbox",props:{label:{required:!1,default:"",type:String},items:{required:!0,type:[Array]},value:{required:!1,type:[String,Number],default:null},name:{required:!0,type:String}},computed:{idName:function(){return this.label.toLowerCase().replace(" ","-")+"-"+Math.floor(100*Math.random())}},methods:{updateValue:function(e){this.$emit("input",e)}}},o=r(11),component=Object(o.a)(n,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"form-group"},[e.label?r("label",{attrs:{for:e.idName}},[e._v(e._s(e.label))]):e._e(),e._v(" "),r("select",{staticClass:"form-control",attrs:{id:e.idName,name:e.name},domProps:{value:e.value},on:{input:function(t){return e.updateValue(t.target.value)}}},[r("option",{attrs:{value:"",selected:""}},[e._v("\n      "+e._s(e.$t("select"))+"\n    ")]),e._v(" "),e._l(e.items,(function(t){return r("option",{key:t.id,domProps:{value:t.id,selected:t.id==e.value?"selected":""}},[e._v("\n      "+e._s(t.title)+"\n    ")])}))],2)])}),[],!1,null,null,null);t.a=component.exports},304:function(e,t,r){"use strict";r(12),r(9);var n={name:"CheckBox",props:{label:{required:!1,default:"",type:String},value:{required:!0,type:[Boolean,Number],default:!1},name:{required:!0,type:String}},computed:{idName:function(){return this.label.toLowerCase().replace(" ","-")+"-"+Math.floor(100*Math.random())}},methods:{updateValue:function(e){this.$emit("input",e)}}},o=r(11),component=Object(o.a)(n,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"form-check"},[r("input",{staticClass:"form-check-input",attrs:{id:e.idName,name:e.name,type:"checkbox"},domProps:{value:e.value,checked:e.value},on:{change:function(t){return e.updateValue(t.target.checked)}}}),e._v(" "),r("label",{staticClass:"form-check-label",attrs:{for:e.idName}},[e._v(e._s(e.label))])])}),[],!1,null,null,null);t.a=component.exports}}]);