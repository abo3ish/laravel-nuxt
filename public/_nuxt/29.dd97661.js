(window.webpackJsonp=window.webpackJsonp||[]).push([[29],{237:function(t,e,r){"use strict";r.r(e);r(30);var n=r(10),o=(r(13),r(47)),d=r.n(o),l=r(323),c=r(104),_={layout:"admin",middleware:"auth",head:function(){return{title:this.user.name}},components:{LabelInputText:l.a,Loading:c.default},data:function(){return{user:{id:"",name:"",email:"",phone:"",channel:"",push_token:"",push_token_type:"",social_id:"",social_provider:"",status:""},addressFields:["id","area","street","building_number","floor_number","flat_number","actions"],form:new d.a({title:"كشف ودوا",body:"",user_id:""})}},mounted:function(){this.fetchData()},methods:{fetchData:function(){var t=this;this.$axios.$get("users/"+this.$route.params.id).then((function(e){t.user=e}))},sendFCM:function(){var t=this;return Object(n.a)(regeneratorRuntime.mark((function e(){return regeneratorRuntime.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return t.form.user_id=t.user.id,e.next=3,t.form.post("/fcm",t.form).then((function(e){e.data>0?t.$notify({group:"feedback",title:t.$t("notification_sent_successfully"),type:"success"}):t.$notify({group:"feedback",title:t.$t("notification_failed"),type:"error"})}));case 3:case"end":return e.stop()}}),e)})))()}}},m=(r(351),r(12)),component=Object(m.a)(_,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[t.user.id?t._e():r("loading"),t._v(" "),r("header-info",{attrs:{name:"users",navigation:[{name:"home",link:"dashboard"},{name:"users",link:"users"},{name:t.user.name,link:"",trans:!1}]}}),t._v(" "),r("div",{staticClass:"row"},[r("div",{staticClass:"col-md-12"},[r("div",{staticClass:"card card-primary"},[r("div",{staticClass:"card-header"},[r("h3",{staticClass:"card-title"},[t._v("\n            "+t._s(t.user.name)+"\n            "),r("n-link",{attrs:{to:{name:"edit-user"}}},[r("button",{staticClass:"btn btn-outline-light float-left"},[t._v("\n                "+t._s(t.$t("edit"))+"\n              ")])])],1)]),t._v(" "),r("div",{staticClass:"card-body"},[r("div",{staticClass:"form-group"},[r("label",{attrs:{for:"balance"}},[t._v(t._s(t.$t("name"))+" : ")]),t._v(" "),r("code",[t._v("\n              "+t._s(t.user.name)+" "),r("br")])]),t._v(" "),r("div",{staticClass:"form-group"},[r("label",{attrs:{for:"balance"}},[t._v(t._s(t.$t("email"))+" : ")]),t._v(" "),r("code",[t._v("\n              "+t._s(t.user.email)+"\n            ")])]),t._v(" "),r("div",{staticClass:"form-group"},[r("label",{attrs:{for:"balance"}},[t._v(t._s(t.$t("status"))+" : ")]),t._v(" "),(t.user.status,r("b-badge",{attrs:{variant:"success"}},[t._v("\n              "+t._s(t.$t("active"))+"\n            ")]))],1),t._v(" "),r("div",{staticClass:"form-group"},[r("label",{attrs:{for:"balance"}},[t._v(t._s(t.$t("address"))+" : ")]),t._v(" "),r("code",{attrs:{id:"address"}},[t._v("\n              "+t._s(t.user.address)+" "),r("br")])]),t._v(" "),r("div",{staticClass:"form-group"},[r("label",[t._v(t._s(t.$t("last_seen"))+" : ")]),t._v(" "),t.user.last_seen?r("code",[t._v("\n              "+t._s(t.$moment(String(t.user.last_seen),"YYYY-MM-DD").format("LLLL"))+" "),r("br")]):t._e()]),t._v(" "),r("div",{staticClass:"form-group"},[r("label",{attrs:{for:"balance"}},[t._v(t._s(t.$t("orders"))+" : ")]),t._v(" "),r("code",[r("nuxt-link",{attrs:{to:{name:"orders",query:{user_id:t.user.id}}}},[t._v(t._s(t.$t("orders")))]),t._v(" |\n            ")],1),t._v(" "),r("label",{attrs:{for:"balance"}},[t._v(t._s(t.$t("orders_count"))+" : ")]),t._v(" "),r("code",[t._v("\n              "+t._s(t.user.orders_count)+"\n            ")])]),t._v(" "),r("div",{staticClass:"form-group"},[r("label",[t._v(t._s(t.$t("created_at"))+" : ")]),t._v(" "),r("code",[t._v("\n              "+t._s(t.$moment(String(t.user.created_at),"YYYY-MM-DD H:I").format("LLLL"))+" "),r("br")])])])]),t._v(" "),r("div",{staticClass:"card card-primary"},[r("div",{staticClass:"card card-header"},[t._v("\n          Notification\n        ")]),t._v(" "),r("div",{staticClass:"card card-body"},[r("form",{attrs:{role:"form"},on:{submit:function(e){return e.preventDefault(),t.sendFCM()}}},[r("label-input-text",{attrs:{label:t.$t("fcm_title"),type:"text",placeholder:"Enter Notification Title",name:"title"},model:{value:t.form.title,callback:function(e){t.$set(t.form,"title",e)},expression:"form.title"}}),t._v(" "),r("label-input-text",{attrs:{label:t.$t("fcm_body"),type:"text",placeholder:"Enter Notification Body",name:"body"},model:{value:t.form.body,callback:function(e){t.$set(t.form,"body",e)},expression:"form.body"}}),t._v(" "),r("div",{staticClass:"card-footer"},[r("v-button",{attrs:{loading:t.form.busy,type:"success"}},[t.form.busy?r("b-spinner",{attrs:{small:"",type:"grow"}}):t._e(),t._v("\n                "+t._s(t.$t("send"))+"\n              ")],1)],1)],1)])]),t._v(" "),r("div",{staticClass:"card card-primary"},[r("div",{staticClass:"card card-header"},[t._v("\n          Addresses\n        ")]),t._v(" "),r("div",{staticClass:"card card-body"},[r("b-table",{attrs:{items:t.user.addresses,fields:t.addressFields,"show-empty":""},scopedSlots:t._u([{key:"cell(area)",fn:function(data){return[data.item.area?r("span",[t._v(t._s(data.item.area.name))]):t._e()]}},{key:"cell(actions)",fn:function(data){return[r("b-button",{attrs:{to:{name:"show-address",params:{id:data.item.id}},variant:"info",size:"sm"}},[t._v("\n                Show\n              ")]),t._v(" "),r("b-button",{attrs:{to:{name:"edit-address",params:{id:data.item.id}},variant:"secondary",size:"sm"}},[t._v("\n                Edit\n              ")]),t._v(" "),r("b-button",{attrs:{variant:"danger",size:"sm"},on:{click:function(e){return e.stopPropagation(),e.preventDefault(),t.deleteItem(data.item.id,e)}}},[t._v("\n                Delete\n              ")])]}}])})],1)])])])],1)}),[],!1,null,"ba50d988",null);e.default=component.exports},323:function(t,e,r){"use strict";r(11),r(9);var n={name:"LabelInputText",props:{label:{required:!1,default:"",type:String},value:{required:!1,type:[String,Number],default:""},type:{required:!0,default:"text",type:String},placeholder:{required:!1,default:"",type:String},name:{required:!0,type:String},required:{required:!1,default:!1,type:Boolean},disabled:{required:!1,default:!1,type:Boolean}},computed:{idName:function(){return this.label.toLowerCase().replace(" ","-")+"-"+Math.floor(100*Math.random())}},methods:{updateValue:function(t){this.$emit("input",t)}}},o=r(12),component=Object(o.a)(n,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"form-group"},[t.label?r("label",{staticClass:"col-form-label",attrs:{for:t.idName}},[t._v(t._s(t.label))]):t._e(),t._v(" "),r("div",{staticClass:"input-group mb-3"},[r("input",{staticClass:"form-control",attrs:{id:t.idName,name:t.name,type:t.type,placeholder:t.placeholder,required:t.required,disabled:t.disabled},domProps:{value:t.value},on:{input:function(e){return t.updateValue(e.target.value)}}})])])}),[],!1,null,null,null);e.a=component.exports},338:function(t,e,r){},351:function(t,e,r){"use strict";var n=r(338);r.n(n).a}}]);