import{m as b,o as c,c as w,w as r,a as e,b as t,u as s,i as d,g as n,j as k,e as u,h as v,F as x,t as _,k as P,l as F,O as p}from"./app-Cxyj-LO2.js";import{_ as S}from"./AdminLayout-DzAcwDTt.js";import{r as M,a as m}from"./HomeIcon-BaBBpbdS.js";import"./HomeIcon-D3-R6IGz.js";import"./transition-Dnr0CMhO.js";import"./keyboard-DFV0bmR6.js";import"./ChevronDownIcon-DUKbdmBo.js";import"./micro-task-BXxnZ-Br.js";const B={class:"mx-4 mt-4 mb-14"},E={class:"flex","aria-label":"Breadcrumb"},V={role:"list",class:"flex items-center space-x-4"},A=e("span",{class:"sr-only"},"Home",-1),j={class:"flex items-center"},N={class:"flex items-center"},D={class:"flex items-center"},O={class:"flex items-center"},U={class:"mt-4 mx-4"},$={class:"bg-white p-6 rounded-2xl border-b shadow-2xl"},C={class:"flex justify-center px-4 py-8"},H={class:"w-full max-w-4xl mx-auto bg-white p-8"},L=e("div",{class:"mb-8"},[e("h1",{class:"text-2xl font-bold text-gray-700 mb-1 text-center"},"Manage Favorite Products"),e("p",{class:"text-gray-600 text-sm text-center"},"Select the 3 products you want to mark as favorites on the main page.")],-1),T=["for"],q=["id","onUpdate:modelValue"],z=e("option",{value:""},"Select a product",-1),G=["value"],I=e("div",{class:"flex items-center justify-between mt-6"},[e("button",{class:"bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline",type:"submit"}," Save Products ")],-1),te={__name:"FavoriteManage",props:{products:Array,favoriteProducts:Array},setup(f){const g=f,o=b({favorite:Array(3).fill("")});g.favoriteProducts.forEach((i,h)=>{o.favorite[h]=i});function y(){p.put("/admin/products/favorite/save",{favorite:o.favorite},{onSuccess:()=>{p.visit("/admin/products/favorite")},onError:i=>{console.error("Error while saving favorite products:",i),alert("Error while saving favorite products: "+i.message)}})}return(i,h)=>(c(),w(S,{title:"Manage Favorite Products"},{default:r(()=>[e("div",B,[e("nav",E,[e("ol",V,[e("li",null,[e("div",null,[t(s(d),{href:"/admin/dashboard",class:"text-gray-400 hover:text-gray-500"},{default:r(()=>[t(s(M),{class:"h-5 w-5 flex-shrink-0","aria-hidden":"true"}),A]),_:1})])]),e("li",null,[e("div",j,[t(s(m),{class:"h-5 w-5 flex-shrink-0 text-gray-400","aria-hidden":"true"}),t(s(d),{href:"/admin/dashboard",class:"ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"},{default:r(()=>[n("Admin")]),_:1})])]),e("li",null,[e("div",N,[t(s(m),{class:"h-5 w-5 flex-shrink-0 text-gray-400","aria-hidden":"true"}),t(s(d),{href:"/admin/products",class:"ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"},{default:r(()=>[n("Products")]),_:1})])]),e("li",null,[e("div",D,[t(s(m),{class:"h-5 w-5 flex-shrink-0 text-gray-400","aria-hidden":"true"}),t(s(d),{href:"/admin/products/favorite",class:"ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"},{default:r(()=>[n("Favorite")]),_:1})])]),e("li",null,[e("div",O,[t(s(m),{class:"h-5 w-5 flex-shrink-0 text-gray-400","aria-hidden":"true"}),t(s(d),{href:"/admin/products/favorite/manage",class:"ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"},{default:r(()=>[n("Manage")]),_:1})])])])])]),e("div",U,[e("div",$,[e("div",C,[e("div",H,[L,e("form",{onSubmit:k(y,["prevent"]),class:"space-y-6"},[(c(!0),u(x,null,v(o.favorite,(J,a)=>(c(),u("div",{key:a},[e("label",{class:"block text-gray-700 text-sm font-bold mb-2",for:"favorite"+a}," Favorite Product "+_(a+1),9,T),P(e("select",{id:"favorite"+a,"onUpdate:modelValue":l=>o.favorite[a]=l,class:"mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"},[z,(c(!0),u(x,null,v(f.products,l=>(c(),u("option",{key:l.id,value:l.id},_(l.name),9,G))),128))],8,q),[[F,o.favorite[a]]])]))),128)),I],32)])])])])]),_:1}))}};export{te as default};
