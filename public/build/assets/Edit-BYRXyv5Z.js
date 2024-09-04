import{d as w,A as G,o as r,c as y,w as u,a as e,b as n,u as i,i as k,g as p,t as x,j as O,k as m,v as _,l as T,e as d,h as g,F as f,O as C,f as R}from"./app-JsxQVuK5.js";import{_ as H}from"./AdminLayout-yxQSrgni.js";import{P as J,N as Q,a as q,S as A}from"./pagination-5pq2a43H.js";import{r as K,a as P}from"./HomeIcon-tNaSnbDF.js";import{r as W}from"./PhotoIcon-B30MP_vc.js";import{r as X}from"./TrashIcon-jymW0gUZ.js";import{r as Y}from"./ArrowPathIcon-Kg3LO40i.js";import"./HomeIcon-CX7JyigJ.js";import"./transition-DM51IVFY.js";import"./keyboard-B1eEn8PW.js";import"./ChevronDownIcon-BFJJcEZk.js";import"./micro-task-BhIf1XMT.js";import"./Bars3Icon-CiW0Tf8T.js";const Z={class:"mx-4 mt-4 mb-14"},ee={class:"flex","aria-label":"Breadcrumb"},te={role:"list",class:"flex items-center space-x-4"},oe=e("span",{class:"sr-only"},"Home",-1),se={class:"flex items-center"},le={class:"flex items-center"},ie={class:"flex items-center"},ae=e("a",{class:"ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"},"Edit",-1),re={class:"mt-4 mx-4"},ne={class:"bg-white p-6 rounded-2xl border-b shadow-2xl"},de={class:"flex justify-center px-4 py-8"},ce={class:"w-full max-w-4xl mx-auto bg-white p-8"},ue={class:"mb-8"},pe={class:"text-2xl font-bold text-gray-900 mb-1 text-center"},me=e("p",{class:"text-gray-600 text-sm text-center"},"Complete the form below to update a product in your store.",-1),ge=e("label",{for:"name",class:"block text-base font-bold text-gray-900"},"Product Name",-1),fe=e("label",{for:"description",class:"block text-base font-bold text-gray-900"},"Description",-1),he={class:"md:flex md:gap-6 md:items-end"},be={class:"md:w-1/2"},ve=e("label",{for:"price",class:"block text-base font-bold text-gray-900"},"Price",-1),xe={class:"md:w-1/2"},_e=e("label",{for:"stock",class:"block text-base font-bold text-gray-900"},"Stock",-1),we=e("label",{for:"categories",class:"block text-base font-bold text-gray-900"},"Categories",-1),ye={class:"my-4 p-4 bg-white border border-gray-200 rounded-lg shadow"},ke={class:"flex items-center"},Ce=e("option",{disabled:"",value:""},"Select a category",-1),Pe=["value"],Ie={class:"flex flex-wrap gap-2 mt-4"},Te=["onClick"],Ae=e("svg",{xmlns:"http://www.w3.org/2000/svg",class:"h-3 w-3",fill:"none",viewBox:"0 0 24 24",stroke:"currentColor"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M6 18L18 6M6 6l12 12"})],-1),Be=[Ae],Ee=e("label",{for:"tags",class:"block text-base font-bold text-gray-900"},"Tags",-1),Me={class:"my-4 p-4 bg-white border border-gray-200 rounded-lg shadow"},Ue={class:"flex items-center"},je=e("option",{disabled:"",value:""},"Select a tag",-1),Se=["value"],Ve={class:"flex flex-wrap gap-2 mt-4"},$e=["onClick"],Ne=e("svg",{xmlns:"http://www.w3.org/2000/svg",class:"h-3 w-3",fill:"none",viewBox:"0 0 24 24",stroke:"currentColor"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M6 18L18 6M6 6l12 12"})],-1),Fe=[Ne],De={class:"col-span-full"},Le=e("label",{for:"cover-photo",class:"block text-base font-bold leading-6 text-gray-900"},"Photo",-1),ze={class:"my-4 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10"},Ge={class:"text-center"},Oe={class:"mt-4 flex text-sm leading-6 text-gray-600"},Re={for:"images",class:"relative cursor-pointer rounded-md bg-white font-semibold text-blue-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-blue-600 focus-within:ring-offset-2 hover:text-blue-500"},He=e("span",null,"Upload a file",-1),Je=e("p",{class:"pl-1"},"or drag and drop",-1),Qe=e("p",{class:"text-xs leading-5 text-gray-600"},"PNG, JPG, GIF up to 10MB",-1),qe=["src"],Ke=["onClick"],We=e("svg",{class:"w-6 h-6",fill:"none",viewBox:"0 0 24 24",stroke:"currentColor"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M6 18L18 6M6 6l12 12"})],-1),Xe=[We],Ye=["src"],Ze=["onClick"],et=e("svg",{class:"w-6 h-6",fill:"none",viewBox:"0 0 24 24",stroke:"currentColor"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M6 18L18 6M6 6l12 12"})],-1),tt=[et],ot=e("div",{class:"swiper-pagination"},null,-1),st=e("div",{class:"swiper-button-prev"},null,-1),lt=e("div",{class:"swiper-button-next"},null,-1),it={class:"flex justify-end mt-4 space-x-4"},at={type:"submit",class:"inline-flex items-center gap-x-2 rounded-md bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"},_t={__name:"Edit",props:{product:Object,tags:Array,productTags:Array,categories:Array,productCategories:Array},setup(I){const a=I,B=a.productTags.map(s=>a.tags.find(t=>t.id===s)),E=a.productCategories.map(s=>a.categories.find(t=>t.id===s)),l=w({name:a.product.name,description:a.product.description,price:a.product.price,stock:a.product.stock,images:[],imagePreviews:[],existingImages:a.product.images||[],deleteImages:[],tags:B,categories:E}),h=w(""),b=w("");function M(s){const t=s.target.files;if(t)for(let o=0;o<t.length;o++){const c=new FileReader;c.onload=v=>{l.value.imagePreviews.push(v.target.result),l.value.images.push(t[o])},c.readAsDataURL(t[o])}}function U(s){l.value.imagePreviews.splice(s,1),l.value.images.splice(s,1)}function j(s){const t=l.value.existingImages[s].id;l.value.deleteImages.push(t),l.value.existingImages.splice(s,1)}function S(){const s=new FormData;s.append("name",l.value.name),s.append("description",l.value.description),s.append("price",l.value.price),s.append("stock",l.value.stock),l.value.categories.forEach(t=>{s.append("categories[]",t.id)}),l.value.tags.forEach(t=>{s.append("tags[]",t.id)}),l.value.images.forEach(t=>{t instanceof File&&s.append("images[]",t)}),l.value.deleteImages.forEach(t=>{s.append("deleteImages[]",t)}),s.append("_method","PUT"),C.post(`/admin/products/${a.product.id}`,s,{headers:{"Content-Type":"multipart/form-data"}}).then(()=>{alert("Producto actualizado correctamente"),C.replace("/admin/products")}).catch(t=>{console.error("Error al actualizar:",t),alert("Error al actualizar el producto")})}function V(){confirm("Are you sure you want to delete this product?")&&C.delete(`/admin/products/${a.product.id}`)}const $=s=>a.tags.find(t=>t.id===s),N=()=>{if(h.value){const s=$(h.value);s&&!l.value.tags.some(t=>t.id===s.id)&&l.value.tags.push(s),h.value=""}},F=s=>{const t=l.value.tags.findIndex(o=>o.id===s);t>-1&&l.value.tags.splice(t,1)},D=G(()=>a.tags.filter(s=>!l.value.tags.some(t=>t.id===s.id)));function L(){if(b.value){const s=a.categories.find(t=>t.id===b.value);s&&!l.value.categories.some(t=>t.id===s.id)&&l.value.categories.push(s),b.value=""}}function z(s){const t=l.value.categories.findIndex(o=>o.id===s);t>-1&&l.value.categories.splice(t,1)}return(s,t)=>(r(),y(H,{title:"Update Product"},{default:u(()=>[e("div",Z,[e("nav",ee,[e("ol",te,[e("li",null,[e("div",null,[n(i(k),{href:"/admin/dashboard",class:"text-gray-400 hover:text-gray-500"},{default:u(()=>[n(i(K),{class:"h-5 w-5 flex-shrink-0","aria-hidden":"true"}),oe]),_:1})])]),e("li",null,[e("div",se,[n(i(P),{class:"h-5 w-5 flex-shrink-0 text-gray-400","aria-hidden":"true"}),n(i(k),{href:"/admin/dashboard",class:"ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"},{default:u(()=>[p("Admin")]),_:1})])]),e("li",null,[e("div",le,[n(i(P),{class:"h-5 w-5 flex-shrink-0 text-gray-400","aria-hidden":"true"}),n(i(k),{href:"/admin/products",class:"ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"},{default:u(()=>[p("Products")]),_:1})])]),e("li",null,[e("div",ie,[n(i(P),{class:"h-5 w-5 flex-shrink-0 text-gray-400","aria-hidden":"true"}),ae])])])])]),e("div",re,[e("div",ne,[e("div",de,[e("div",ce,[e("div",ue,[e("h1",pe,"Update "+x(l.value.name),1),me]),e("form",{onSubmit:O(S,["prevent"]),class:"space-y-6"},[e("div",null,[ge,m(e("input",{"onUpdate:modelValue":t[0]||(t[0]=o=>l.value.name=o),type:"text",id:"name",name:"name",class:"my-4 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500",placeholder:"Product..."},null,512),[[_,l.value.name]])]),e("div",null,[fe,m(e("textarea",{"onUpdate:modelValue":t[1]||(t[1]=o=>l.value.description=o),id:"description",name:"description",rows:"4",class:"my-4 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500",placeholder:"Provide a detailed description of the product"},null,512),[[_,l.value.description]])]),e("div",he,[e("div",be,[ve,m(e("input",{"onUpdate:modelValue":t[2]||(t[2]=o=>l.value.price=o),type:"text",id:"price",name:"price",class:"my-4 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500",placeholder:"0.00"},null,512),[[_,l.value.price]])]),e("div",xe,[_e,m(e("input",{"onUpdate:modelValue":t[3]||(t[3]=o=>l.value.stock=o),type:"number",id:"stock",name:"stock",class:"my-4 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500",placeholder:"Quantity"},null,512),[[_,l.value.stock]])])]),e("div",null,[we,e("div",ye,[e("div",ke,[m(e("select",{"onUpdate:modelValue":t[4]||(t[4]=o=>b.value=o),class:"flex-grow bg-gray-100 border-none rounded-l-lg py-2 px-4 focus:ring-1 focus:ring-blue-500 focus:outline-none"},[Ce,(r(!0),d(f,null,g(I.categories,o=>(r(),d("option",{key:o.id,value:o.id},x(o.name),9,Pe))),128))],512),[[T,b.value]]),e("button",{type:"button",onClick:L,class:"bg-blue-500 hover:bg-blue-600 text-white font-bold rounded-r-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500"}," Add ")]),e("div",Ie,[(r(!0),d(f,null,g(l.value.categories,(o,c)=>(r(),d("div",{key:o.id,class:"flex items-center bg-green-600 text-white rounded py-2 px-3 text-sm font-semibold cursor-pointer hover:bg-green-700"},[p(x(o.name)+" ",1),e("button",{onClick:v=>z(o.id),class:"ml-2 bg-red-500 hover:bg-red-600 text-white rounded-full p-0.5"},Be,8,Te)]))),128))])])]),e("div",null,[Ee,e("div",Me,[e("div",Ue,[m(e("select",{"onUpdate:modelValue":t[5]||(t[5]=o=>h.value=o),class:"flex-grow bg-gray-100 border-none rounded-l-lg py-2 px-4 focus:ring-1 focus:ring-blue-500 focus:outline-none"},[je,(r(!0),d(f,null,g(D.value,o=>(r(),d("option",{key:o.id,value:o.id},x(o.name),9,Se))),128))],512),[[T,h.value]]),e("button",{type:"button",onClick:N,class:"bg-blue-500 hover:bg-blue-600 text-white font-bold rounded-r-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500"}," Add ")]),e("div",Ve,[(r(!0),d(f,null,g(l.value.tags,(o,c)=>(r(),d("div",{key:o.id,class:"flex items-center bg-blue-600 text-white rounded-full py-2 px-3 text-sm font-semibold cursor-pointer hover:bg-blue-700"},[p(x(o.name)+" ",1),e("button",{onClick:v=>F(o.id),class:"ml-2 bg-red-500 hover:bg-red-600 text-white rounded-full p-0.5"},Fe,8,$e)]))),128))])])]),e("div",De,[Le,e("div",ze,[e("div",Ge,[n(i(W),{class:"mx-auto h-12 w-12 text-gray-300","aria-hidden":"true"}),e("div",Oe,[e("label",Re,[He,e("input",{id:"images",name:"images[]",type:"file",class:"sr-only",multiple:"",onChange:M},null,32)]),Je]),Qe])])]),n(i(q),{slidesPerView:1,spaceBetween:30,loop:l.value.existingImages.length>1,pagination:{clickable:!0,el:".swiper-pagination"},navigation:{nextEl:".swiper-button-next",prevEl:".swiper-button-prev"},modules:[i(J),i(Q)],class:"mySwiper"},{default:u(()=>[(r(!0),d(f,null,g(l.value.existingImages,(o,c)=>(r(),y(i(A),{key:c},{default:u(()=>[e("img",{src:o.url,alt:"Product Image",class:"object-cover rounded-lg shadow-md h-96"},null,8,qe),o.delete?R("",!0):(r(),d("button",{key:0,onClick:v=>j(c),class:"absolute top-0 right-0 m-2 bg-red-500 text-white p-1 rounded-full"},Xe,8,Ke))]),_:2},1024))),128)),(r(!0),d(f,null,g(l.value.imagePreviews,(o,c)=>(r(),y(i(A),{key:c},{default:u(()=>[e("img",{src:o,alt:"New image",class:"object-cover rounded-lg shadow-md h-96"},null,8,Ye),e("button",{onClick:v=>U(c),class:"absolute top-0 right-0 m-2 bg-red-500 text-white p-1 rounded-full"},tt,8,Ze)]),_:2},1024))),128)),ot,st,lt]),_:1},8,["loop","pagination","navigation","modules"]),e("div",it,[e("button",{type:"button",onClick:V,class:"inline-flex items-center gap-x-2 rounded-md bg-red-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600"},[n(i(X),{class:"-ml-0.5 h-5 w-5","aria-hidden":"true"}),p(" Delete Product ")]),e("button",at,[n(i(Y),{class:"-ml-0.5 h-5 w-5","aria-hidden":"true"}),p(" Update Product ")])])],32)])])])])]),_:1}))}};export{_t as default};
