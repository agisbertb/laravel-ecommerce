import{T as w,d as k,o as d,c as p,w as l,a as e,b as r,u as t,i as c,g as m,j as C,k as u,v as h,l as P,e as g,h as N,F as B,f as S,t as V,O as j}from"./app-Cxyj-LO2.js";import{_ as D}from"./AdminLayout-DzAcwDTt.js";import{S as M,P as F,N as U,a as A}from"./pagination-D5ZMdE0S.js";import{r as E,a as f}from"./HomeIcon-BaBBpbdS.js";import{r as I}from"./PhotoIcon-CDaB388w.js";import{r as T}from"./PlusIcon-CQqJZYAV.js";import"./HomeIcon-D3-R6IGz.js";import"./transition-Dnr0CMhO.js";import"./keyboard-DFV0bmR6.js";import"./ChevronDownIcon-DUKbdmBo.js";import"./micro-task-BXxnZ-Br.js";const $={class:"mx-4 mt-4 mb-14"},G={class:"flex","aria-label":"Breadcrumb"},L={role:"list",class:"flex items-center space-x-4"},O=e("span",{class:"sr-only"},"Home",-1),R={class:"flex items-center"},H={class:"flex items-center"},J={class:"flex items-center"},q={class:"mt-4 mx-4"},z={class:"bg-white p-6 rounded-2xl border-b shadow-2xl"},K={class:"flex justify-center px-4 py-8"},Q={class:"w-full max-w-4xl mx-auto bg-white p-8"},W=e("div",{class:"mb-8"},[e("h1",{class:"text-2xl font-bold text-gray-700 mb-1 text-center"},"Add a New Category"),e("p",{class:"text-gray-600 text-sm text-center"},"Complete the form below to list a new product in your store.")],-1),X=e("label",{for:"name",class:"block text-sm font-medium text-gray-700"},"Category Name",-1),Y=e("label",{for:"description",class:"block text-sm font-medium text-gray-700"},"Description",-1),Z=e("label",{for:"parent_id",class:"block text-sm font-medium text-gray-700"},"Parent Category",-1),ee=e("option",{value:""},"No parent",-1),te=["value"],se={class:"col-span-full"},oe=e("label",{for:"cover-photo",class:"block text-base font-bold leading-6 text-gray-900"},"Photo",-1),ae={class:"my-4 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10"},re={class:"text-center"},ie={class:"mt-4 flex text-sm leading-6 text-gray-600"},le={for:"image",class:"relative cursor-pointer rounded-md bg-white font-bold text-blue-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-blue-600 focus-within:ring-offset-2 hover:text-blue-500"},ne=e("span",null,"Upload a file",-1),de=e("p",{class:"pl-1"},"or drag and drop",-1),ce=e("p",{class:"text-xs leading-5 text-gray-600"}," PNG, JPG, GIF up to 10MB ",-1),me=["src"],ue=e("svg",{class:"w-6 h-6",fill:"none",viewBox:"0 0 24 24",stroke:"currentColor"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M6 18L18 6M6 6l12 12"})],-1),fe=[ue],pe={class:"flex justify-end mt-4"},he={type:"submit",class:"inline-flex items-center gap-x-2 rounded-md bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"},Be={__name:"Create",props:{categories:Array},setup(_){const s=w({name:"",description:"",parent_id:null,image:null});function x(){const i=new FormData;i.append("name",s.name),i.append("description",s.description),i.append("parent_id",s.parent_id||""),s.image&&i.append("image",s.image),j.post("/admin/categories",i,{onBefore:()=>({headers:{"Content-Type":"multipart/form-data"}}),onSuccess:()=>{alert("Category created successfully.")},onError:o=>{console.error("Error creating category:",o),alert("Error creating the category")}})}const n=k("");function b(i){const o=i.target.files[0];if(o){s.image=o;const a=new FileReader;a.onload=y=>{n.value=y.target.result},a.readAsDataURL(o)}}function v(){s.image=null,n.value=""}return(i,o)=>(d(),p(D,{title:"Create Product"},{default:l(()=>[e("div",$,[e("nav",G,[e("ol",L,[e("li",null,[e("div",null,[r(t(c),{href:"/admin/dashboard",class:"text-gray-400 hover:text-gray-500"},{default:l(()=>[r(t(E),{class:"h-5 w-5 flex-shrink-0","aria-hidden":"true"}),O]),_:1})])]),e("li",null,[e("div",R,[r(t(f),{class:"h-5 w-5 flex-shrink-0 text-gray-400","aria-hidden":"true"}),r(t(c),{href:"/admin/dashboard",class:"ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"},{default:l(()=>[m("Admin")]),_:1})])]),e("li",null,[e("div",H,[r(t(f),{class:"h-5 w-5 flex-shrink-0 text-gray-400","aria-hidden":"true"}),r(t(c),{href:"/admin/categories",class:"ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"},{default:l(()=>[m("Categories")]),_:1})])]),e("li",null,[e("div",J,[r(t(f),{class:"h-5 w-5 flex-shrink-0 text-gray-400","aria-hidden":"true"}),r(t(c),{href:"/admin/categories/create",class:"ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"},{default:l(()=>[m("Create")]),_:1})])])])])]),e("div",q,[e("div",z,[e("div",K,[e("div",Q,[W,e("form",{onSubmit:C(x,["prevent"]),class:"space-y-6"},[e("div",null,[X,u(e("input",{"onUpdate:modelValue":o[0]||(o[0]=a=>t(s).name=a),type:"text",id:"name",name:"name",class:"mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500",placeholder:"Category..."},null,512),[[h,t(s).name]])]),e("div",null,[Y,u(e("textarea",{"onUpdate:modelValue":o[1]||(o[1]=a=>t(s).description=a),id:"description",name:"description",rows:"4",class:"mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500",placeholder:"Provide a detailed description of the category"},null,512),[[h,t(s).description]])]),e("div",null,[Z,u(e("select",{"onUpdate:modelValue":o[2]||(o[2]=a=>t(s).parent_id=a),id:"parent_id",name:"parent_id",class:"mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"},[ee,(d(!0),g(B,null,N(_.categories,a=>(d(),g("option",{key:a.id,value:a.id},V(a.name),9,te))),128))],512),[[P,t(s).parent_id]])]),e("div",se,[oe,e("div",ae,[e("div",re,[r(t(I),{class:"mx-auto h-12 w-12 text-gray-300","aria-hidden":"true"}),e("div",ie,[e("label",le,[ne,e("input",{id:"image",ref:"imageInput",type:"file",class:"sr-only",multiple:"",onChange:b},null,544)]),de]),ce])])]),r(t(A),{modules:[t(F),t(U)],class:"mySwiper",spaceBetween:"{30}",slidesPerView:"{1}",navigation:"",pagination:""},{default:l(()=>[n.value?(d(),p(t(M),{key:0},{default:l(()=>[e("img",{src:n.value,alt:"Preview",class:"object-cover rounded-lg shadow-md h-96"},null,8,me),e("button",{onClick:v,class:"absolute top-0 right-0 m-2 bg-red-500 text-white p-1 rounded-full"},fe)]),_:1})):S("",!0)]),_:1},8,["modules"]),e("div",pe,[e("button",he,[r(t(T),{class:"-ml-0.5 h-5 w-5","aria-hidden":"true"}),m(" Create category ")])])],32)])])])])]),_:1}))}};export{Be as default};