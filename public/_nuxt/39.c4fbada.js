(window.webpackJsonp=window.webpackJsonp||[]).push([[39],{202:function(e,t,r){"use strict";r.r(t);r(13);var n=r(47),l=r.n(n),o=r(323),c=r(326),d={layout:"admin",middleware:"auth",head:function(){return{title:this.form.name}},components:{LabelInputText:o.a,CheckBox:c.a},data:function(){return{area:{},form:new l.a({name:"",status:Boolean(!1)})}},methods:{updatead:function(){var e=this;this.form.post("/areas",this.form).then((function(t){e.form.reset(),e.$notify({group:"feedback",title:e.$t("area_saved_successfully"),type:"success"})})).catch((function(t){e.$notify({group:"feedback",title:e.$t("area_saved_failed"),type:"error"})}))}}},m=r(12),component=Object(m.a)(d,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("header-info",{attrs:{name:"areas",navigation:[{name:"home",link:"dashboard"},{name:"areas",link:"areas"},{name:e.form.name,link:"",trans:!1}]}}),e._v(" "),r("div",{staticClass:"row"},[r("div",{staticClass:"col-md-12"},[r("div",{staticClass:"card card-primary"},[r("div",{staticClass:"card-header"},[r("h3",{staticClass:"card-title"},[e._v("\n            "+e._s(e.form.name)+"\n            "),r("n-link",{attrs:{to:{name:"create-area"}}},[r("button",{staticClass:"btn btn-outline-light float-left"},[e._v("\n                "+e._s(e.$t("add_new"))+"\n              ")])])],1)]),e._v(" "),r("form",{attrs:{role:"form"},on:{submit:function(t){return t.preventDefault(),e.updatead()}}},[r("div",{staticClass:"card-body"},[r("label-input-text",{attrs:{label:e.$t("name"),type:"text",placeholder:"Enter Name",name:"Name"},model:{value:e.form.name,callback:function(t){e.$set(e.form,"name",t)},expression:"form.name"}}),e._v(" "),r("check-box",{attrs:{label:e.$t("activate"),name:"status"},model:{value:e.form.status,callback:function(t){e.$set(e.form,"status",t)},expression:"form.status"}}),e._v(" "),r("div",{staticClass:"card-footer"},[r("v-button",{attrs:{loading:e.form.busy,type:"success"}},[e._v("\n                "+e._s(e.$t("save"))+"\n              ")])],1)],1)])])])])],1)}),[],!1,null,null,null);t.default=component.exports},323:function(e,t,r){"use strict";r(11),r(9);var n={name:"LabelInputText",props:{label:{required:!1,default:"",type:String},value:{required:!1,type:[String,Number],default:""},type:{required:!0,default:"text",type:String},placeholder:{required:!1,default:"",type:String},name:{required:!0,type:String},required:{required:!1,default:!1,type:Boolean},disabled:{required:!1,default:!1,type:Boolean}},computed:{idName:function(){return this.label.toLowerCase().replace(" ","-")+"-"+Math.floor(100*Math.random())}},methods:{updateValue:function(e){this.$emit("input",e)}}},l=r(12),component=Object(l.a)(n,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"form-group"},[e.label?r("label",{staticClass:"col-form-label",attrs:{for:e.idName}},[e._v(e._s(e.label))]):e._e(),e._v(" "),r("div",{staticClass:"input-group mb-3"},[r("input",{staticClass:"form-control",attrs:{id:e.idName,name:e.name,type:e.type,placeholder:e.placeholder,required:e.required,disabled:e.disabled},domProps:{value:e.value},on:{input:function(t){return e.updateValue(t.target.value)}}})])])}),[],!1,null,null,null);t.a=component.exports},326:function(e,t,r){"use strict";r(11),r(9);var n={name:"CheckBox",props:{label:{required:!1,default:"",type:String},value:{required:!0,type:[Boolean,Number],default:!1},name:{required:!0,type:String}},computed:{idName:function(){return this.label.toLowerCase().replace(" ","-")+"-"+Math.floor(100*Math.random())}},methods:{updateValue:function(e){this.$emit("input",e)}}},l=r(12),component=Object(l.a)(n,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"form-check"},[r("input",{staticClass:"form-check-input",attrs:{id:e.idName,name:e.name,type:"checkbox"},domProps:{value:e.value,checked:e.value},on:{change:function(t){return e.updateValue(t.target.checked)}}}),e._v(" "),r("label",{staticClass:"form-check-label",attrs:{for:e.idName}},[e._v(e._s(e.label))])])}),[],!1,null,null,null);t.a=component.exports}}]);