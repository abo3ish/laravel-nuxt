(window.webpackJsonp=window.webpackJsonp||[]).push([[12],{182:function(t,e,r){"use strict";r.r(e);r(29);var o=r(10),l={layout:"default",head:function(){return{title:this.$t("login")}},data:function(){return{form:{email:"",password:""},remember:!1}},methods:{login:function(){var t=this;return Object(o.a)(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,t.$auth.loginWith("local",{data:t.form});case 3:t.$router.push({name:"home"}),e.next=9;break;case 6:e.prev=6,e.t0=e.catch(0),console.log(e.t0);case 9:case"end":return e.stop()}}),e,null,[[0,6]])})))()}}},n=r(12),component=Object(n.a)(l,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"row"},[r("div",{staticClass:"col-lg-8 m-auto"},[r("card",{attrs:{title:t.$t("login")}},[r("form",{on:{submit:function(e){return e.preventDefault(),t.login(e)}}},[r("div",{staticClass:"form-group row"},[r("label",{staticClass:"col-md-3 col-form-label text-md-right"},[t._v(t._s(t.$t("email")))]),t._v(" "),r("div",{staticClass:"col-md-7"},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.form.email,expression:"form.email"}],staticClass:"form-control",class:{"is-invalid":t.errors.email},attrs:{type:"email",name:"email"},domProps:{value:t.form.email},on:{input:function(e){e.target.composing||t.$set(t.form,"email",e.target.value)}}}),t._v(" "),t.errors.email?r("div",{staticClass:"invalid-feedback"},[t._v("\n              "+t._s(t.errors.email[0])+"\n            ")]):t._e()])]),t._v(" "),r("div",{staticClass:"form-group row"},[r("label",{staticClass:"col-md-3 col-form-label text-md-right"},[t._v(t._s(t.$t("password")))]),t._v(" "),r("div",{staticClass:"col-md-7"},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.form.password,expression:"form.password"}],staticClass:"form-control",class:{"is-invalid":t.errors.email},attrs:{type:"password",name:"password"},domProps:{value:t.form.password},on:{input:function(e){e.target.composing||t.$set(t.form,"password",e.target.value)}}})])]),t._v(" "),r("div",{staticClass:"form-group row"},[r("div",{staticClass:"col-md-3"}),t._v(" "),r("div",{staticClass:"col-md-7 d-flex"},[r("checkbox",{attrs:{name:"remember"},model:{value:t.remember,callback:function(e){t.remember=e},expression:"remember"}},[t._v("\n              "+t._s(t.$t("remember_me"))+"\n            ")]),t._v(" "),r("router-link",{staticClass:"small ml-auto my-auto",attrs:{to:{name:"password.request"}}},[t._v("\n              "+t._s(t.$t("forgot_password"))+"\n            ")])],1)]),t._v(" "),r("div",{staticClass:"form-group row"},[r("div",{staticClass:"col-md-7 offset-md-3 d-flex"},[r("v-button",{attrs:{loading:t.form.busy}},[t._v("\n              "+t._s(t.$t("login"))+"\n            ")]),t._v(" "),r("login-with-github")],1)])])])],1)])}),[],!1,null,null,null);e.default=component.exports}}]);