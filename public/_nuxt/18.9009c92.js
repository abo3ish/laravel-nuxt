(window.webpackJsonp=window.webpackJsonp||[]).push([[18],{198:function(e,t,r){"use strict";r.r(t);r(29);var l=r(10),n=r(47),o=r.n(n),c=r(302),d=r(303),m=r(304),v={layout:"admin",components:{LabelInputText:c.a,SelectBox:d.a,CheckBox:m.a},data:function(){return{serviceProviderTypes:[],form:new o.a({name:"",email:"",phone:"",age:"",address:"",password:"",status:Boolean(!0),type_id:""})}},created:function(){var e=this;this.$axios.$get("service-provider-types").then((function(t){e.serviceProviderTypes=t}))},methods:{create:function(){var e=this;return Object(l.a)(regeneratorRuntime.mark((function t(){return regeneratorRuntime.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,e.form.post("/service-providers",e.form);case 2:e.form.reset(),e.$notify({group:"feedback",title:e.$t("service_provider_created_sucessfully"),type:"success"});case 4:case"end":return t.stop()}}),t)})))()}}},f=r(11),component=Object(f.a)(v,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("section",{staticClass:"content-header"},[r("div",{staticClass:"container-fluid"},[r("div",{staticClass:"row mb-2"},[r("div",{staticClass:"col-sm-6"},[r("h1",[e._v(e._s(e.$t("service_providers")))])]),e._v(" "),r("div",{staticClass:"col-sm-6"},[r("ol",{staticClass:"breadcrumb float-sm-left"},[r("li",{staticClass:"breadcrumb-item"},[r("nuxt-link",{attrs:{to:{name:"home"}}},[e._v("\n                "+e._s(e.$t("home"))+"\n              ")])],1),e._v(" "),r("li",{staticClass:"breadcrumb-item active"},[r("nuxt-link",{attrs:{to:{name:"service-providers"}}},[e._v("\n                "+e._s(e.$t("service_providers"))+"\n              ")])],1),e._v(" "),r("li",{staticClass:"breadcrumb-item active"},[e._v("\n              "+e._s(e.$t("new_service_provider"))+"\n            ")])])])])])]),e._v(" "),r("div",{staticClass:"row"},[r("div",{staticClass:"col-md-12"},[r("div",{staticClass:"card card-primary"},[r("div",{staticClass:"card-header"},[r("h3",{staticClass:"card-title"},[e._v("\n            "+e._s(e.$t("create_new_service_provider"))+"\n          ")])]),e._v(" "),r("form",{attrs:{role:"form"},on:{submit:function(t){return t.preventDefault(),e.create()}}},[r("div",{staticClass:"card-body"},[r("label-input-text",{attrs:{label:e.$t("name"),type:"text",placeholder:"Enter Name",name:"name"},model:{value:e.form.name,callback:function(t){e.$set(e.form,"name",t)},expression:"form.name"}}),e._v(" "),r("label-input-text",{attrs:{label:e.$t("email"),type:"email",placeholder:"Enter Email Address",name:"email"},model:{value:e.form.email,callback:function(t){e.$set(e.form,"email",t)},expression:"form.email"}}),e._v(" "),r("label-input-text",{attrs:{label:e.$t("password"),type:"password",placeholder:"Enter Password",name:"password"},model:{value:e.form.password,callback:function(t){e.$set(e.form,"password",t)},expression:"form.password"}}),e._v(" "),r("label-input-text",{attrs:{label:e.$t("address"),type:"text",placeholder:"Enter Address",name:"address"},model:{value:e.form.address,callback:function(t){e.$set(e.form,"address",t)},expression:"form.address"}}),e._v(" "),r("label-input-text",{attrs:{label:e.$t("phone"),type:"text",placeholder:"Enter Phone",name:"phone"},model:{value:e.form.phone,callback:function(t){e.$set(e.form,"phone",t)},expression:"form.phone"}}),e._v(" "),r("label-input-text",{attrs:{label:e.$t("age"),type:"number",placeholder:"Enter Age",name:"age"},model:{value:e.form.age,callback:function(t){e.$set(e.form,"age",t)},expression:"form.age"}}),e._v(" "),r("select-box",{attrs:{items:e.serviceProviderTypes,label:e.$t("service_provider_type"),name:"type_id"},model:{value:e.form.type_id,callback:function(t){e.$set(e.form,"type_id",t)},expression:"form.type_id"}}),e._v(" "),r("check-box",{attrs:{label:e.$t("activate"),name:"status"},model:{value:e.form.status,callback:function(t){e.$set(e.form,"status",t)},expression:"form.status"}}),e._v(" "),r("div",{staticClass:"card-footer"},[r("v-button",{attrs:{loading:e.form.busy,type:"success"}},[e._v("\n                "+e._s(e.$t("save"))+"\n              ")])],1)],1)])])])])])}),[],!1,null,null,null);t.default=component.exports},302:function(e,t,r){"use strict";r(12),r(9);var l={name:"LabelInputText",props:{label:{required:!1,default:"",type:String},value:{required:!1,type:[String,Number],default:""},type:{required:!0,default:"text",type:String},placeholder:{required:!1,default:"",type:String},name:{required:!0,type:String}},computed:{idName:function(){return this.label.toLowerCase().replace(" ","-")+"-"+Math.floor(100*Math.random())}},methods:{updateValue:function(e){this.$emit("input",e)}}},n=r(11),component=Object(n.a)(l,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"form-group"},[e.label?r("label",{staticClass:"col-form-label",attrs:{for:e.idName}},[e._v(e._s(e.label))]):e._e(),e._v(" "),r("div",{staticClass:"input-group mb-3"},[r("input",{staticClass:"form-control",attrs:{id:e.idName,name:e.name,type:e.type,placeholder:e.placeholder},domProps:{value:e.value},on:{input:function(t){return e.updateValue(t.target.value)}}})])])}),[],!1,null,null,null);t.a=component.exports},303:function(e,t,r){"use strict";r(12),r(9);var l={name:"Selectbox",props:{label:{required:!1,default:"",type:String},items:{required:!0,type:[Array]},value:{required:!1,type:[String,Number],default:null},name:{required:!0,type:String}},computed:{idName:function(){return this.label.toLowerCase().replace(" ","-")+"-"+Math.floor(100*Math.random())}},methods:{updateValue:function(e){this.$emit("input",e)}}},n=r(11),component=Object(n.a)(l,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"form-group"},[e.label?r("label",{attrs:{for:e.idName}},[e._v(e._s(e.label))]):e._e(),e._v(" "),r("select",{staticClass:"form-control",attrs:{id:e.idName,name:e.name},domProps:{value:e.value},on:{input:function(t){return e.updateValue(t.target.value)}}},[r("option",{attrs:{value:"",selected:""}},[e._v("\n      "+e._s(e.$t("select"))+"\n    ")]),e._v(" "),e._l(e.items,(function(t){return r("option",{key:t.id,domProps:{value:t.id,selected:t.id==e.value?"selected":""}},[e._v("\n      "+e._s(t.title)+"\n    ")])}))],2)])}),[],!1,null,null,null);t.a=component.exports},304:function(e,t,r){"use strict";r(12),r(9);var l={name:"CheckBox",props:{label:{required:!1,default:"",type:String},value:{required:!0,type:[Boolean,Number],default:!1},name:{required:!0,type:String}},computed:{idName:function(){return this.label.toLowerCase().replace(" ","-")+"-"+Math.floor(100*Math.random())}},methods:{updateValue:function(e){this.$emit("input",e)}}},n=r(11),component=Object(n.a)(l,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"form-check"},[r("input",{staticClass:"form-check-input",attrs:{id:e.idName,name:e.name,type:"checkbox"},domProps:{value:e.value,checked:e.value},on:{change:function(t){return e.updateValue(t.target.checked)}}}),e._v(" "),r("label",{staticClass:"form-check-label",attrs:{for:e.idName}},[e._v(e._s(e.label))])])}),[],!1,null,null,null);t.a=component.exports}}]);