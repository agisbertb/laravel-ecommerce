import{m as b,o as d,c as w,w as r,a as e,b as t,u as a,i as n,g as c,j as k,e as u,h as g,F as x,t as _,k as C,l as F,O as y}from"./app-Cxyj-LO2.js";import{_ as S}from"./AdminLayout-DzAcwDTt.js";import{r as M,a as m}from"./HomeIcon-BaBBpbdS.js";import"./HomeIcon-D3-R6IGz.js";import"./transition-Dnr0CMhO.js";import"./keyboard-DFV0bmR6.js";import"./ChevronDownIcon-DUKbdmBo.js";import"./micro-task-BXxnZ-Br.js";const B={class:"mx-4 mt-4 mb-14"},E={class:"flex","aria-label":"Breadcrumb"},V={role:"list",class:"flex items-center space-x-4"},A=e("span",{class:"sr-only"},"Home",-1),j={class:"flex items-center"},N={class:"flex items-center"},D={class:"flex items-center"},O={class:"flex items-center"},U={class:"mt-4 mx-4"},$={class:"bg-white p-6 rounded-2xl border-b shadow-2xl"},H={class:"flex justify-center px-4 py-8"},L={class:"w-full max-w-4xl mx-auto bg-white p-8"},T=e("div",{class:"mb-8"},[e("h1",{class:"text-2xl font-bold text-gray-700 mb-1 text-center"},"Manage Featured Categories"),e("p",{class:"text-gray-600 text-sm text-center"},"Select the 3 categories you want to feature on the main page.")],-1),q=["for"],z=["id","onUpdate:modelValue"],G=e("option",{value:""},"Select a category",-1),I=["value"],J=e("div",{class:"flex items-center justify-between mt-6"},[e("button",{class:"bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline",type:"submit"}," Save Categories ")],-1),te={__name:"FeaturedManage",props:{categories:Array,featuredCategories:Array},setup(f){const v=f,o=b({featured:Array(3).fill("")});v.featuredCategories.forEach((i,h)=>{o.featured[h]=i});function p(){y.put("/admin/categories/featured/save",{featured:o.featured},{onSuccess:()=>{y.visit("/admin/categories/featured")},onError:i=>{console.error("Error while saving featured categories:",i),alert("Error while saving featured categories: "+i.message)}})}return(i,h)=>(d(),w(S,{title:"Manage Featured Categories"},{default:r(()=>[e("div",B,[e("nav",E,[e("ol",V,[e("li",null,[e("div",null,[t(a(n),{href:"/admin/dashboard",class:"text-gray-400 hover:text-gray-500"},{default:r(()=>[t(a(M),{class:"h-5 w-5 flex-shrink-0","aria-hidden":"true"}),A]),_:1})])]),e("li",null,[e("div",j,[t(a(m),{class:"h-5 w-5 flex-shrink-0 text-gray-400","aria-hidden":"true"}),t(a(n),{href:"/admin/dashboard",class:"ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"},{default:r(()=>[c("Admin")]),_:1})])]),e("li",null,[e("div",N,[t(a(m),{class:"h-5 w-5 flex-shrink-0 text-gray-400","aria-hidden":"true"}),t(a(n),{href:"/admin/categories",class:"ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"},{default:r(()=>[c("Categories")]),_:1})])]),e("li",null,[e("div",D,[t(a(m),{class:"h-5 w-5 flex-shrink-0 text-gray-400","aria-hidden":"true"}),t(a(n),{href:"/admin/categories/featured",class:"ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"},{default:r(()=>[c("Featured")]),_:1})])]),e("li",null,[e("div",O,[t(a(m),{class:"h-5 w-5 flex-shrink-0 text-gray-400","aria-hidden":"true"}),t(a(n),{href:"/admin/categories/featured/manage",class:"ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"},{default:r(()=>[c("Manage")]),_:1})])])])])]),e("div",U,[e("div",$,[e("div",H,[e("div",L,[T,e("form",{onSubmit:k(p,["prevent"]),class:"space-y-6"},[(d(!0),u(x,null,g(o.featured,(K,s)=>(d(),u("div",{key:s},[e("label",{class:"block text-gray-700 text-sm font-bold mb-2",for:"featured"+s}," Featured Category "+_(s+1),9,q),C(e("select",{id:"featured"+s,"onUpdate:modelValue":l=>o.featured[s]=l,class:"mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"},[G,(d(!0),u(x,null,g(f.categories,l=>(d(),u("option",{key:l.id,value:l.id},_(l.name),9,I))),128))],8,z),[[F,o.featured[s]]])]))),128)),J],32)])])])])]),_:1}))}};export{te as default};