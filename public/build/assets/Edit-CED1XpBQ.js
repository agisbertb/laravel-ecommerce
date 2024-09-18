import{m as b,o as _,c as w,w as i,a as e,b as s,u as t,i as n,g as d,t as y,j as v,k as m,v as u,O as f}from"./app-Cxyj-LO2.js";import{_ as g}from"./AdminLayout-DzAcwDTt.js";import{r as k,a as c}from"./HomeIcon-BaBBpbdS.js";import{r as U}from"./TrashIcon-BUxSh_lh.js";import{r as V}from"./ArrowPathIcon-BW6EyuUt.js";import"./HomeIcon-D3-R6IGz.js";import"./transition-Dnr0CMhO.js";import"./keyboard-DFV0bmR6.js";import"./ChevronDownIcon-DUKbdmBo.js";import"./micro-task-BXxnZ-Br.js";const $={class:"mx-4 mt-4 mb-14"},j={class:"flex","aria-label":"Breadcrumb"},B={role:"list",class:"flex items-center space-x-4"},N=e("span",{class:"sr-only"},"Home",-1),C={class:"flex items-center"},D={class:"flex items-center"},E={class:"flex items-center"},O=e("a",{class:"ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"},"Edit",-1),A={class:"mt-4 mx-4"},M={class:"bg-white p-6 rounded-2xl border-b shadow-2xl"},S={class:"flex justify-center px-4 py-8"},T={class:"w-full max-w-4xl mx-auto bg-white p-8"},H={class:"mb-8"},P={class:"text-2xl font-bold text-gray-700 mb-1 text-center"},q=e("p",{class:"text-gray-600 text-sm text-center"},"Complete the form below to update a user in your store.",-1),z=e("label",{for:"name",class:"block text-sm font-medium text-gray-700"},"Name",-1),F=e("label",{for:"email",class:"block text-sm font-medium text-gray-700"},"Email",-1),G=e("label",{for:"password",class:"block text-sm font-medium text-gray-700"},"Password",-1),I={class:"flex justify-end mt-4 space-x-4"},J={type:"submit",class:"inline-flex items-center gap-x-2 rounded-md bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"},oe={__name:"Edit",props:{user:Object},setup(x){const l=x,o=b({name:l.user.name,email:l.user.email,password:l.user.password});function p(){f.put(`/admin/users/${l.user.id}`,o)}function h(){confirm("Are you sure you want to delete this user?")&&f.delete(`/admin/users/${l.user.id}`)}return(K,a)=>(_(),w(g,{title:"Update user"},{default:i(()=>[e("div",$,[e("nav",j,[e("ol",B,[e("li",null,[e("div",null,[s(t(n),{href:"/admin/dashboard",class:"text-gray-400 hover:text-gray-500"},{default:i(()=>[s(t(k),{class:"h-5 w-5 flex-shrink-0","aria-hidden":"true"}),N]),_:1})])]),e("li",null,[e("div",C,[s(t(c),{class:"h-5 w-5 flex-shrink-0 text-gray-400","aria-hidden":"true"}),s(t(n),{href:"/admin/dashboard",class:"ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"},{default:i(()=>[d("Admin")]),_:1})])]),e("li",null,[e("div",D,[s(t(c),{class:"h-5 w-5 flex-shrink-0 text-gray-400","aria-hidden":"true"}),s(t(n),{href:"/admin/users",class:"ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"},{default:i(()=>[d("Users")]),_:1})])]),e("li",null,[e("div",E,[s(t(c),{class:"h-5 w-5 flex-shrink-0 text-gray-400","aria-hidden":"true"}),O])])])])]),e("div",A,[e("div",M,[e("div",S,[e("div",T,[e("div",H,[e("h1",P,"Update "+y(o.name),1),q]),e("form",{onSubmit:v(p,["prevent"]),class:"space-y-6"},[e("div",null,[z,m(e("input",{"onUpdate:modelValue":a[0]||(a[0]=r=>o.name=r),type:"text",id:"name",name:"name",class:"mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500",placeholder:"user..."},null,512),[[u,o.name]])]),e("div",null,[F,m(e("input",{"onUpdate:modelValue":a[1]||(a[1]=r=>o.email=r),type:"text",id:"email",name:"email",class:"mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500",placeholder:"user@example.com"},null,512),[[u,o.email]])]),e("div",null,[G,m(e("input",{"onUpdate:modelValue":a[2]||(a[2]=r=>o.password=r),type:"password",id:"password",name:"password",class:"mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500",placeholder:"password"},null,512),[[u,o.password]])]),e("div",I,[e("button",{type:"button",onClick:h,class:"inline-flex items-center gap-x-2 rounded-md bg-red-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600"},[s(t(U),{class:"-ml-0.5 h-5 w-5","aria-hidden":"true"}),d(" Delete User ")]),e("button",J,[s(t(V),{class:"-ml-0.5 h-5 w-5","aria-hidden":"true"}),d(" Update User ")])])],32)])])])])]),_:1}))}};export{oe as default};
