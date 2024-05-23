import{o as i,c as N,w as e,a as t,r as y,T as x,d as b,e as c,b as o,f as g,g as l,u as a,F as w,h as $,n as C,t as h}from"./app-JsxQVuK5.js";import{_ as L,a as z,b as U,c as T,d as W,S as E,e as A}from"./SectionBorder-DviAhNtk.js";import{_ as S}from"./Checkbox-bmAr-iYp.js";import{_ as H}from"./DangerButton-DUH4tg2s.js";import{_ as B,a as Y,b as q}from"./TextInput-C6mSNl3m.js";import{_ as I}from"./PrimaryButton-DXPfP65V.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const G={class:"bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4"},J={class:"sm:flex sm:items-start"},K=t("div",{class:"mx-auto shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10"},[t("svg",{class:"h-6 w-6 text-red-600",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"})])],-1),O={class:"mt-3 text-center sm:mt-0 sm:ms-4 sm:text-start"},Q={class:"text-lg font-medium text-gray-900"},R={class:"mt-4 text-sm text-gray-600"},X={class:"flex flex-row justify-end px-6 py-4 bg-gray-100 text-end"},Z={__name:"ConfirmationModal",props:{show:{type:Boolean,default:!1},maxWidth:{type:String,default:"2xl"},closeable:{type:Boolean,default:!0}},emits:["close"],setup(d,{emit:P}){const r=P,m=()=>{r("close")};return(u,_)=>(i(),N(L,{show:d.show,"max-width":d.maxWidth,closeable:d.closeable,onClose:m},{default:e(()=>[t("div",G,[t("div",J,[K,t("div",O,[t("h3",Q,[y(u.$slots,"title")]),t("div",R,[y(u.$slots,"content")])])])]),t("div",X,[y(u.$slots,"footer")])]),_:3},8,["show","max-width","closeable"]))}},ee={class:"col-span-6 sm:col-span-4"},se={key:0,class:"col-span-6"},te={class:"mt-2 grid grid-cols-1 md:grid-cols-2 gap-4"},oe={class:"flex items-center"},ne={class:"ms-2 text-sm text-gray-600"},le={key:0},ae={class:"mt-10 sm:mt-0"},ie={class:"space-y-6"},re={class:"break-all"},ce={class:"flex items-center ms-2"},de={key:0,class:"text-sm text-gray-400"},me=["onClick"],ue=["onClick"],pe=t("div",null," Please copy your new API token. For your security, it won't be shown again. ",-1),fe={key:0,class:"mt-4 bg-gray-100 px-4 py-2 rounded font-mono text-sm text-gray-500 break-all"},ve={class:"grid grid-cols-1 md:grid-cols-2 gap-4"},_e={class:"flex items-center"},ke={class:"ms-2 text-sm text-gray-600"},Ce={__name:"ApiTokenManager",props:{tokens:Array,availablePermissions:Array,defaultPermissions:Array},setup(d){const r=x({name:"",permissions:d.defaultPermissions}),m=x({permissions:[]}),u=x({}),_=b(!1),f=b(null),v=b(null),F=()=>{r.post(route("api-tokens.store"),{preserveScroll:!0,onSuccess:()=>{_.value=!0,r.reset()}})},V=p=>{m.permissions=p.abilities,f.value=p},j=()=>{m.put(route("api-tokens.update",f.value),{preserveScroll:!0,preserveState:!0,onSuccess:()=>f.value=null})},D=p=>{v.value=p},M=()=>{u.delete(route("api-tokens.destroy",v.value),{preserveScroll:!0,preserveState:!0,onSuccess:()=>v.value=null})};return(p,n)=>(i(),c("div",null,[o(z,{onSubmitted:F},{title:e(()=>[l(" Create API Token ")]),description:e(()=>[l(" API tokens allow third-party services to authenticate with our application on your behalf. ")]),form:e(()=>[t("div",ee,[o(B,{for:"name",value:"Name"}),o(Y,{id:"name",modelValue:a(r).name,"onUpdate:modelValue":n[0]||(n[0]=s=>a(r).name=s),type:"text",class:"mt-1 block w-full",autofocus:""},null,8,["modelValue"]),o(q,{message:a(r).errors.name,class:"mt-2"},null,8,["message"])]),d.availablePermissions.length>0?(i(),c("div",se,[o(B,{for:"permissions",value:"Permissions"}),t("div",te,[(i(!0),c(w,null,$(d.availablePermissions,s=>(i(),c("div",{key:s},[t("label",oe,[o(S,{checked:a(r).permissions,"onUpdate:checked":n[1]||(n[1]=k=>a(r).permissions=k),value:s},null,8,["checked","value"]),t("span",ne,h(s),1)])]))),128))])])):g("",!0)]),actions:e(()=>[o(W,{on:a(r).recentlySuccessful,class:"me-3"},{default:e(()=>[l(" Created. ")]),_:1},8,["on"]),o(I,{class:C({"opacity-25":a(r).processing}),disabled:a(r).processing},{default:e(()=>[l(" Create ")]),_:1},8,["class","disabled"])]),_:1}),d.tokens.length>0?(i(),c("div",le,[o(E),t("div",ae,[o(U,null,{title:e(()=>[l(" Manage API Tokens ")]),description:e(()=>[l(" You may delete any of your existing tokens if they are no longer needed. ")]),content:e(()=>[t("div",ie,[(i(!0),c(w,null,$(d.tokens,s=>(i(),c("div",{key:s.id,class:"flex items-center justify-between"},[t("div",re,h(s.name),1),t("div",ce,[s.last_used_ago?(i(),c("div",de," Last used "+h(s.last_used_ago),1)):g("",!0),d.availablePermissions.length>0?(i(),c("button",{key:1,class:"cursor-pointer ms-6 text-sm text-gray-400 underline",onClick:k=>V(s)}," Permissions ",8,me)):g("",!0),t("button",{class:"cursor-pointer ms-6 text-sm text-red-500",onClick:k=>D(s)}," Delete ",8,ue)])]))),128))])]),_:1})])])):g("",!0),o(T,{show:_.value,onClose:n[3]||(n[3]=s=>_.value=!1)},{title:e(()=>[l(" API Token ")]),content:e(()=>[pe,p.$page.props.jetstream.flash.token?(i(),c("div",fe,h(p.$page.props.jetstream.flash.token),1)):g("",!0)]),footer:e(()=>[o(A,{onClick:n[2]||(n[2]=s=>_.value=!1)},{default:e(()=>[l(" Close ")]),_:1})]),_:1},8,["show"]),o(T,{show:f.value!=null,onClose:n[6]||(n[6]=s=>f.value=null)},{title:e(()=>[l(" API Token Permissions ")]),content:e(()=>[t("div",ve,[(i(!0),c(w,null,$(d.availablePermissions,s=>(i(),c("div",{key:s},[t("label",_e,[o(S,{checked:a(m).permissions,"onUpdate:checked":n[4]||(n[4]=k=>a(m).permissions=k),value:s},null,8,["checked","value"]),t("span",ke,h(s),1)])]))),128))])]),footer:e(()=>[o(A,{onClick:n[5]||(n[5]=s=>f.value=null)},{default:e(()=>[l(" Cancel ")]),_:1}),o(I,{class:C(["ms-3",{"opacity-25":a(m).processing}]),disabled:a(m).processing,onClick:j},{default:e(()=>[l(" Save ")]),_:1},8,["class","disabled"])]),_:1},8,["show"]),o(Z,{show:v.value!=null,onClose:n[8]||(n[8]=s=>v.value=null)},{title:e(()=>[l(" Delete API Token ")]),content:e(()=>[l(" Are you sure you would like to delete this API token? ")]),footer:e(()=>[o(A,{onClick:n[7]||(n[7]=s=>v.value=null)},{default:e(()=>[l(" Cancel ")]),_:1}),o(H,{class:C(["ms-3",{"opacity-25":a(u).processing}]),disabled:a(u).processing,onClick:M},{default:e(()=>[l(" Delete ")]),_:1},8,["class","disabled"])]),_:1},8,["show"])]))}};export{Ce as default};