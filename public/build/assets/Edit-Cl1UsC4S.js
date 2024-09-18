import{m as b,o as g,c as _,w as l,a as e,b as t,u as s,i as n,g as r,t as v,j as y,k as m,v as u,O as f}from"./app-Cxyj-LO2.js";import{_ as w}from"./AdminLayout-DzAcwDTt.js";import{r as k,a as c}from"./HomeIcon-BaBBpbdS.js";import{r as $}from"./TrashIcon-BUxSh_lh.js";import{r as T}from"./ArrowPathIcon-BW6EyuUt.js";import"./HomeIcon-D3-R6IGz.js";import"./transition-Dnr0CMhO.js";import"./keyboard-DFV0bmR6.js";import"./ChevronDownIcon-DUKbdmBo.js";import"./micro-task-BXxnZ-Br.js";const U={class:"mx-4 mt-4 mb-14"},V={class:"flex","aria-label":"Breadcrumb"},j={role:"list",class:"flex items-center space-x-4"},B=e("span",{class:"sr-only"},"Home",-1),D={class:"flex items-center"},N={class:"flex items-center"},C={class:"flex items-center"},O=e("a",{class:"ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"},"Edit",-1),A={class:"mt-4 mx-4"},E={class:"bg-white p-6 rounded-2xl border-b shadow-2xl"},M={class:"flex justify-center px-4 py-8"},S={class:"w-full max-w-4xl mx-auto bg-white p-8"},H={class:"mb-8"},P={class:"text-2xl font-bold text-gray-700 mb-1 text-center"},q=e("p",{class:"text-gray-600 text-sm text-center"},"Complete the form below to update a tag in your store.",-1),z=e("label",{for:"name",class:"block text-sm font-medium text-gray-700"},"Name",-1),F=e("label",{for:"description",class:"block text-sm font-medium text-gray-700"},"Description",-1),G={class:"flex justify-end mt-4 space-x-4"},I={type:"submit",class:"inline-flex items-center gap-x-2 rounded-md bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"},se={__name:"Edit",props:{tag:Object},setup(x){const o=x,a=b({name:o.tag.name,description:o.tag.description,price:o.tag.price,stock:o.tag.stock,image:o.tag.image});function h(){f.put(`/admin/tags/${o.tag.id}`,a)}function p(){confirm("Are you sure you want to delete this tag?")&&f.delete(`/admin/tags/${o.tag.id}`)}return(J,i)=>(g(),_(w,{title:"Update tag"},{default:l(()=>[e("div",U,[e("nav",V,[e("ol",j,[e("li",null,[e("div",null,[t(s(n),{href:"/admin/dashboard",class:"text-gray-400 hover:text-gray-500"},{default:l(()=>[t(s(k),{class:"h-5 w-5 flex-shrink-0","aria-hidden":"true"}),B]),_:1})])]),e("li",null,[e("div",D,[t(s(c),{class:"h-5 w-5 flex-shrink-0 text-gray-400","aria-hidden":"true"}),t(s(n),{href:"/admin/dashboard",class:"ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"},{default:l(()=>[r("Admin")]),_:1})])]),e("li",null,[e("div",N,[t(s(c),{class:"h-5 w-5 flex-shrink-0 text-gray-400","aria-hidden":"true"}),t(s(n),{href:"/admin/tags",class:"ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"},{default:l(()=>[r("Tags")]),_:1})])]),e("li",null,[e("div",C,[t(s(c),{class:"h-5 w-5 flex-shrink-0 text-gray-400","aria-hidden":"true"}),O])])])])]),e("div",A,[e("div",E,[e("div",M,[e("div",S,[e("div",H,[e("h1",P,"Update "+v(a.name),1),q]),e("form",{onSubmit:y(h,["prevent"]),class:"space-y-6"},[e("div",null,[z,m(e("input",{"onUpdate:modelValue":i[0]||(i[0]=d=>a.name=d),type:"text",id:"name",name:"name",class:"mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500",placeholder:"tag..."},null,512),[[u,a.name]])]),e("div",null,[F,m(e("textarea",{"onUpdate:modelValue":i[1]||(i[1]=d=>a.description=d),id:"description",name:"description",rows:"4",class:"mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500",placeholder:"Provide a detailed description of the tag"},null,512),[[u,a.description]])]),e("div",G,[e("button",{type:"button",onClick:p,class:"inline-flex items-center gap-x-2 rounded-md bg-red-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600"},[t(s($),{class:"-ml-0.5 h-5 w-5","aria-hidden":"true"}),r(" Delete Tag ")]),e("button",I,[t(s(T),{class:"-ml-0.5 h-5 w-5","aria-hidden":"true"}),r(" Update Tag ")])])],32)])])])])]),_:1}))}};export{se as default};
