(window.webpackJsonp=window.webpackJsonp||[]).push([[37],{212:function(t,e,r){"use strict";r.r(e);r(102);var l=r(47),n=r.n(l),o={layout:"admin",middleware:"auth",head:function(){return{title:this.serviceProviderType.title}},components:{LabelInputText:r(312).a},data:function(){return{serviceProviderType:{},form:new n.a({title:"",description:"",slug:""}),type:""}},created:function(){this.fetchData()},methods:{fetchData:function(){var t=this;this.$axios.$get("service-provider-types/"+this.$route.params.id).then((function(e){t.form.fill(e),t.serviceProviderType=e}))},update:function(){var t=this;this.form.put("/service-provider-types/"+this.$route.params.id,this.form).then((function(e){t.form.fill(e.data),t.serviceProviderType=e.data})),this.$notify({group:"feedback",title:this.$t("service_provider_type_updated_sucessfully"),type:"success"})}}},c=r(12),component=Object(c.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("section",{staticClass:"content-header"},[r("div",{staticClass:"container-fluid"},[r("div",{staticClass:"row mb-2"},[r("div",{staticClass:"col-sm-6"},[r("h1",[t._v(t._s(t.$t("service_providers")))])]),t._v(" "),r("div",{staticClass:"col-sm-6"},[r("ol",{staticClass:"breadcrumb float-sm-left"},[r("li",{staticClass:"breadcrumb-item"},[r("nuxt-link",{attrs:{to:{name:"home"}}},[t._v("\n                "+t._s(t.$t("home"))+"\n              ")])],1),t._v(" "),r("li",{staticClass:"breadcrumb-item active"},[r("nuxt-link",{attrs:{to:{name:"service-provider-types"}}},[t._v("\n                "+t._s(t.$t("service_provider_types"))+"\n              ")])],1),t._v(" "),r("li",{staticClass:"breadcrumb-item active"},[t._v("\n              "+t._s(t.serviceProviderType.title)+"\n            ")])])])])])]),t._v(" "),r("div",{staticClass:"row"},[r("div",{staticClass:"col-md-12"},[r("div",{staticClass:"card card-primary"},[r("div",{staticClass:"card-header"},[r("h3",{staticClass:"card-title"},[t._v("\n            "+t._s(t.serviceProviderType.title)+"\n            "),r("n-link",{attrs:{to:{name:"create-service-provider-type"}}},[r("button",{staticClass:"btn btn-outline-light float-left"},[t._v("\n                "+t._s(t.$t("add_new"))+"\n              ")])])],1)]),t._v(" "),r("form",{attrs:{role:"form"},on:{submit:function(e){return e.preventDefault(),t.update()}}},[r("div",{staticClass:"card-body"},[r("label-input-text",{attrs:{label:t.$t("title"),type:"text",placeholder:"Enter Title",name:"title"},model:{value:t.form.title,callback:function(e){t.$set(t.form,"title",e)},expression:"form.title"}}),t._v(" "),r("label-input-text",{attrs:{label:t.$t("description"),type:"text",placeholder:"Enter Description",name:"description"},model:{value:t.form.description,callback:function(e){t.$set(t.form,"description",e)},expression:"form.description"}}),t._v(" "),r("label-input-text",{attrs:{label:t.$t("slug"),type:"text",placeholder:"Enter Slug",name:"slug"},model:{value:t.form.slug,callback:function(e){t.$set(t.form,"slug",e)},expression:"form.slug"}}),t._v(" "),r("div",{staticClass:"card-footer"},[r("v-button",{attrs:{loading:t.form.busy,type:"success"}},[t._v("\n                "+t._s(t.$t("save"))+"\n              ")])],1)],1)])])])])])}),[],!1,null,null,null);e.default=component.exports},312:function(t,e,r){"use strict";r(11),r(9);var l={name:"LabelInputText",props:{label:{required:!1,default:"",type:String},value:{required:!1,type:[String,Number],default:""},type:{required:!0,default:"text",type:String},placeholder:{required:!1,default:"",type:String},name:{required:!0,type:String}},computed:{idName:function(){return this.label.toLowerCase().replace(" ","-")+"-"+Math.floor(100*Math.random())}},methods:{updateValue:function(t){this.$emit("input",t)}}},n=r(12),component=Object(n.a)(l,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"form-group"},[t.label?r("label",{staticClass:"col-form-label",attrs:{for:t.idName}},[t._v(t._s(t.label))]):t._e(),t._v(" "),r("div",{staticClass:"input-group mb-3"},[r("input",{staticClass:"form-control",attrs:{id:t.idName,name:t.name,type:t.type,placeholder:t.placeholder},domProps:{value:t.value},on:{input:function(e){return t.updateValue(e.target.value)}}})])])}),[],!1,null,null,null);e.a=component.exports}}]);