import{A as u}from"./AppLayout-RL1yZ6o4.js";import{V as d,d as p,o as l,c as i,w as r,a as e,t as h}from"./app-JsxQVuK5.js";import"./FooterSection-B3qla_kT.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./ExclamationCircleIcon-Deok98lu.js";import"./Bars3Icon-CiW0Tf8T.js";/*!
  * vue-router v4.3.2
  * (c) 2024 Eduardo San Martin Morote
  * @license MIT
  */var a;(function(t){t.pop="pop",t.push="push"})(a||(a={}));var c;(function(t){t.back="back",t.forward="forward",t.unknown=""})(c||(c={}));var n;(function(t){t[t.aborted=4]="aborted",t[t.cancelled=8]="cancelled",t[t.duplicated=16]="duplicated"})(n||(n={}));const m=Symbol("");function _(){return d(m)}const f=e("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"}," Payment Error ",-1),b={class:"container mx-auto py-12 px-4"},x={class:"bg-white shadow rounded-lg p-6"},y=e("h3",{class:"text-lg font-semibold mb-4"},"We encountered a problem",-1),g=e("p",null,"Unfortunately, there was an issue processing your payment. Please try again or contact our support if the problem persists.",-1),w={class:"mt-4"},k=e("a",{href:"/checkout",class:"mt-6 px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700"}," Return to Checkout ",-1),M={__name:"Error",setup(t){const o=_(),s=p("");return o.query.message&&(s.value=o.query.message),(E,v)=>(l(),i(u,{title:"Payment Error"},{header:r(()=>[f]),default:r(()=>[e("div",b,[e("div",x,[y,g,e("p",w,"Error Message: "+h(s.value),1),k])])]),_:1}))}};export{M as default};
