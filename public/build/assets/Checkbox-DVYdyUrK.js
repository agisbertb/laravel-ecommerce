import{A as r,k as n,I as d,o as p,e as i}from"./app-Cxyj-LO2.js";const k=["value"],h={__name:"Checkbox",props:{checked:{type:[Array,Boolean],default:!1},value:{type:String,default:null}},emits:["update:checked"],setup(e,{emit:c}){const s=c,l=e,t=r({get(){return l.checked},set(o){s("update:checked",o)}});return(o,a)=>n((p(),i("input",{"onUpdate:modelValue":a[0]||(a[0]=u=>t.value=u),type:"checkbox",value:e.value,class:"rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"},null,8,k)),[[d,t.value]])}};export{h as _};
