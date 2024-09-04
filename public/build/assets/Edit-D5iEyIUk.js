import{m,o as c,c as p,w as l,a as e,j as f,k as r,v as i,I as b,b as y,g,O as n}from"./app-JsxQVuK5.js";import{_ as x}from"./PrimaryButton-DXPfP65V.js";import{_}from"./ProfileLayout-Dx4qE_-S.js";import"./AppLayout-RL1yZ6o4.js";import"./FooterSection-B3qla_kT.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./ExclamationCircleIcon-Deok98lu.js";import"./Bars3Icon-CiW0Tf8T.js";import"./UserIcon-C5xJ_kCf.js";import"./HomeIcon-CX7JyigJ.js";const w=e("h2",{class:"text-xl font-semibold mb-4"},"Edit Address",-1),k=e("label",{for:"name",class:"block text-sm font-medium text-gray-700"},"Name",-1),h=e("label",{for:"address",class:"block text-sm font-medium text-gray-700"},"Address",-1),v=e("label",{for:"city",class:"block text-sm font-medium text-gray-700"},"City",-1),V=e("label",{for:"state",class:"block text-sm font-medium text-gray-700"},"State",-1),U=e("label",{for:"country",class:"block text-sm font-medium text-gray-700"},"Country",-1),q=e("label",{for:"zip_code",class:"block text-sm font-medium text-gray-700"},"Zip Code",-1),z={for:"default",class:"flex items-center space-x-2"},C=e("span",{class:"text-sm font-medium text-gray-700"},"Set as default address",-1),N={class:"flex justify-end"},Z={__name:"Edit",props:{address:Object},setup(a){const d=a,t=m({id:d.address.id,name:d.address.name,type:d.address.type,address:d.address.address,city:d.address.city,state:d.address.state,country:d.address.country,zip_code:d.address.zip_code,default:!!d.address.default});function u(){n.put(`/profile/addresses/${t.id}`,t,{onSuccess:()=>{n.visit("/profile/addresses")}})}return(S,s)=>(c(),p(_,null,{default:l(()=>[e("div",null,[w,e("form",{onSubmit:f(u,["prevent"]),class:"space-y-6"},[e("div",null,[k,r(e("input",{type:"text",id:"name","onUpdate:modelValue":s[0]||(s[0]=o=>t.name=o),required:"",class:"mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"},null,512),[[i,t.name]])]),e("div",null,[h,r(e("input",{type:"text",id:"address","onUpdate:modelValue":s[1]||(s[1]=o=>t.address=o),required:"",class:"mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"},null,512),[[i,t.address]])]),e("div",null,[v,r(e("input",{type:"text",id:"city","onUpdate:modelValue":s[2]||(s[2]=o=>t.city=o),required:"",class:"mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"},null,512),[[i,t.city]])]),e("div",null,[V,r(e("input",{type:"text",id:"state","onUpdate:modelValue":s[3]||(s[3]=o=>t.state=o),required:"",class:"mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"},null,512),[[i,t.state]])]),e("div",null,[U,r(e("input",{type:"text",id:"country","onUpdate:modelValue":s[4]||(s[4]=o=>t.country=o),required:"",class:"mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"},null,512),[[i,t.country]])]),e("div",null,[q,r(e("input",{type:"text",id:"zip_code","onUpdate:modelValue":s[5]||(s[5]=o=>t.zip_code=o),required:"",class:"mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"},null,512),[[i,t.zip_code]])]),e("div",null,[e("label",z,[r(e("input",{type:"checkbox",id:"default","onUpdate:modelValue":s[6]||(s[6]=o=>t.default=o),class:"rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"},null,512),[[b,t.default]]),C])]),e("div",N,[y(x,{type:"submit"},{default:l(()=>[g(" Update ")]),_:1})])],32)])]),_:1}))}};export{Z as default};
