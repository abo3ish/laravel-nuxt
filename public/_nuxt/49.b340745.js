(window.webpackJsonp=window.webpackJsonp||[]).push([[49],{207:function(t,e,r){"use strict";r.r(e);r(30);var o=r(10),n=r(47),l=r.n(n),m={middleware:"guest",metaInfo:function(){return{title:this.$t("verify_email")}},data:function(){return{status:"",form:new l.a({email:""})}},created:function(){this.$route.query.email&&(this.form.email=this.$route.query.email)},methods:{send:function(){var t=this;return Object(o.a)(regeneratorRuntime.mark((function e(){var r,data;return regeneratorRuntime.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,t.form.post("/email/resend");case 2:r=e.sent,data=r.data,t.status=data.status,t.form.reset();case 6:case"end":return e.stop()}}),e)})))()}}},c=r(12),component=Object(c.a)(m,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"row"},[r("div",{staticClass:"col-lg-8 m-auto"},[r("card",{attrs:{title:t.$t("verify_email")}},[r("form",{on:{submit:function(e){return e.preventDefault(),t.send(e)},keydown:function(e){return t.form.onKeydown(e)}}},[r("alert-success",{attrs:{form:t.form,message:t.status}}),t._v(" "),r("div",{staticClass:"form-group row"},[r("label",{staticClass:"col-md-3 col-form-label text-md-right"},[t._v(t._s(t.$t("email")))]),t._v(" "),r("div",{staticClass:"col-md-7"},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.form.email,expression:"form.email"}],staticClass:"form-control",class:{"is-invalid":t.form.errors.has("email")},attrs:{type:"email",name:"email"},domProps:{value:t.form.email},on:{input:function(e){e.target.composing||t.$set(t.form,"email",e.target.value)}}}),t._v(" "),r("has-error",{attrs:{form:t.form,field:"email"}})],1)]),t._v(" "),r("div",{staticClass:"form-group row"},[r("div",{staticClass:"col-md-9 ml-md-auto"},[r("v-button",{attrs:{loading:t.form.busy}},[t._v("\n              "+t._s(t.$t("send_verification_link"))+"\n            ")])],1)])],1)])],1)])}),[],!1,null,null,null);e.default=component.exports}}]);