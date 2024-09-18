import{d as y,p as U,s as I,q as P,o as a,c as z,w as m,a as e,b as o,u as i,i as x,e as n,h as v,F as g,k as S,v as T,g as f,x as F,n as B,y as q,t as u,O as L,f as _}from"./app-Cxyj-LO2.js";import{_ as Q,r as R}from"./AdminLayout-DzAcwDTt.js";import{_ as G}from"./AlertNotification-D5CAYTCq.js";import{r as J,a as j}from"./HomeIcon-BaBBpbdS.js";import{r as K,a as A}from"./ChevronLeftIcon-_UR9GOBL.js";import{r as W}from"./ChevronDownIcon-DUKbdmBo.js";import{r as X}from"./PlusIcon-CQqJZYAV.js";import{r as Y}from"./PencilSquareIcon-DqpRFWyz.js";import{r as Z}from"./TrashIcon-BUxSh_lh.js";import"./HomeIcon-D3-R6IGz.js";import"./transition-Dnr0CMhO.js";import"./keyboard-DFV0bmR6.js";import"./micro-task-BXxnZ-Br.js";import"./ExclamationCircleIcon-0VQos8pm.js";const ee={class:"mx-4 mt-4 mb-14"},te={class:"flex","aria-label":"Breadcrumb"},se={role:"list",class:"flex items-center space-x-4"},re=e("span",{class:"sr-only"},"Home",-1),oe={class:"flex items-center"},ae=["href","aria-current"],ie={class:"mt-4 mx-4"},ne={class:"bg-white p-6 rounded-2xl border-b shadow-2xl"},le={class:"sm:flex sm:items-center sm:justify-between"},de={class:"relative inline-block text-left"},ce=e("label",{for:"mobile-search-candidate",class:"sr-only"},"Search",-1),ue=e("label",{for:"desktop-search-candidate",class:"sr-only"},"Search",-1),me={class:"flex rounded-md shadow-sm"},fe={class:"relative flex-grow focus-within:z-10"},he={class:"pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"},xe={class:"text-gray-700"},ge={class:"mt-4 sm:mt-0 sm:ml-16 sm:flex sm:flex-row-reverse"},pe={type:"button",class:"inline-flex items-center gap-x-2 rounded-md bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"},be={class:"mt-8 flow-root"},ye={class:"-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8"},ve={class:"inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8"},_e={class:"overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg"},we={class:"min-w-full divide-y divide-gray-300"},ke=e("thead",{class:"bg-gray-100"},[e("tr",null,[e("th",{scope:"col",class:"px-3 py-3.5 text-sm font-semibold text-center text-gray-900"}," Image"),e("th",{scope:"col",class:"px-3 py-3.5 text-sm font-semibold text-center text-gray-900"},"Name "),e("th",{scope:"col",class:"px-3 py-3.5 text-sm font-semibold text-center text-gray-900"}," Categories "),e("th",{scope:"col",class:"px-3 py-3.5 text-sm font-semibold text-center text-gray-900"},"Tags "),e("th",{scope:"col",class:"px-3 py-3.5 text-sm font-semibold text-center text-gray-900"}," Price"),e("th",{scope:"col",class:"px-3 py-3.5 text-sm font-semibold text-center text-gray-900"}," Stock"),e("th",{scope:"col",class:"px-3 py-3.5 text-sm font-semibold text-center text-gray-900"}," Action")])],-1),$e={class:"divide-y divide-gray-200 bg-white"},Ce={class:"border-t"},Se=["src"],je={class:"border-t"},Ne={class:"border-t"},Ee={class:"flex flex-wrap items-center justify-center gap-2 px-6 py-4"},Pe=["onClick"],Te={class:"border-t"},Be={class:"flex flex-wrap items-center justify-center gap-2 px-6 py-4"},Le=["onClick"],Ae={class:"border-t"},He={class:"border-t"},Me={class:"border-t"},Ve={class:"flex justify-center space-x-4"},De=["onClick"],Oe={class:"flex items-center border-t border-gray-200 bg-white px-4 py-3 sm:px-6"},Ue={class:"text-sm text-gray-700"},Ie={class:"font-medium"},ze={class:"font-medium"},Fe={class:"font-medium"},qe={class:"flex justify-end flex-grow"},Qe={class:"inline-flex rounded-md shadow-sm","aria-label":"Pagination"},Re=["href"],Ge=e("span",{class:"sr-only"},"Previous",-1),Je={key:1,class:"relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-300"},Ke=e("span",{class:"sr-only"},"Previous",-1),We=["href"],Xe=["href"],Ye=e("span",{class:"sr-only"},"Next",-1),Ze={key:3,class:"relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-300"},et=e("span",{class:"sr-only"},"Next",-1),xt={__name:"Index",props:{products:Object,flash:Object},setup(l){const w=l,H=[{name:"Admin",href:"/admin/dashboard",current:!1},{name:"Products",href:"/admin/products",current:!0}],h=y(!1),N=y(""),p=y(""),b=y(!1),$=y(""),M=r=>{!r.target.closest(".dropdown-button")&&!r.target.closest(".dropdown-menu")&&(h.value=!1)};U(()=>{w.flash&&w.flash.success&&($.value=w.flash.success,b.value=!0,setTimeout(()=>{b.value=!1},5e3))}),I(()=>{window.removeEventListener("click",M)}),P(p,r=>{E(r)}),P(()=>w.flash.success,r=>{r&&($.value=r,b.value=!0,setTimeout(()=>{b.value=!1},5e3))},{immediate:!0});const V=(r,s)=>{let t=r-1,c=r+1;const d=[];t<1&&(t=1),c>s&&(c=s);for(let C=t;C<=c;C++)d.push(C);return t>2&&(d.unshift("..."),d.unshift(1)),c<s-1?(d.push("..."),d.push(s)):c===s-1&&d.push(s),d};function E(r,s=N.value){L.get("/admin/products",{search:r,order:s},{preserveState:!0,replace:!0,preserveScroll:!0})}function k(r){N.value=r,E(p.value,r),h.value=!1}function D(r){confirm("Are you sure you want to delete this product?")&&L.delete(`/admin/products/${r}`)}const O=r=>{r.isCategoriesExpanded=!r.isCategoriesExpanded};return(r,s)=>(a(),z(Q,{title:"Products"},{default:m(()=>[e("div",ee,[e("nav",te,[e("ol",se,[e("li",null,[e("div",null,[o(i(x),{href:"/admin/dashboard",class:"text-gray-400 hover:text-gray-500"},{default:m(()=>[o(i(J),{class:"h-5 w-5 flex-shrink-0","aria-hidden":"true"}),re]),_:1})])]),(a(),n(g,null,v(H,t=>e("li",{key:t.name},[e("div",oe,[o(i(j),{class:"h-5 w-5 flex-shrink-0 text-gray-400","aria-hidden":"true"}),e("a",{href:t.href,class:"ml-4 text-sm font-medium text-gray-500 hover:text-gray-700","aria-current":t.current?"page":void 0},u(t.name),9,ae)])])),64))])])]),o(G,{title:"Success",message:$.value,visible:b.value,"onUpdate:visible":s[0]||(s[0]=t=>b.value=t)},null,8,["message","visible"]),e("div",ie,[e("div",ne,[e("div",le,[e("div",de,[ce,ue,e("div",me,[e("div",fe,[e("div",he,[o(i(R),{class:"h-5 w-5 text-gray-400","aria-hidden":"true"})]),S(e("input",{"onUpdate:modelValue":s[1]||(s[1]=t=>p.value=t),id:"mobile-search-candidate",name:"search",type:"search",class:"block w-full rounded-none rounded-l-md border-0 py-1.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:hidden",placeholder:"Search"},null,512),[[T,p.value]]),S(e("input",{"onUpdate:modelValue":s[2]||(s[2]=t=>p.value=t),id:"desktop-search-candidate",name:"search-mobile",type:"search",class:"hidden w-full rounded-none rounded-l-md border-0 py-1.5 pl-10 text-sm leading-6 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:block",placeholder:"Search products"},null,512),[[T,p.value]])]),e("button",{onClick:s[3]||(s[3]=t=>h.value=!h.value),type:"button",class:"dropdown-button relative -ml-px inline-flex items-center gap-x-1.5 rounded-r-md px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50"},[o(i(K),{class:"-ml-0.5 h-5 w-5 text-gray-400","aria-hidden":"true"}),f(" Sort "),o(i(W),{class:"-mr-1 h-5 w-5 text-gray-400","aria-hidden":"true"})]),o(q,{name:"dropdown","enter-active-class":"transition ease-out duration-200","enter-from-class":"transform scale-95 opacity-0","enter-to-class":"transform scale-100 opacity-100","leave-active-class":"transition ease-in duration-150","leave-from-class":"transform scale-100 opacity-100","leave-to-class":"transform scale-95 opacity-0"},{default:m(()=>[S(e("div",{class:B(["dropdown-menu absolute right-0 top-full mt-1 rounded-md bg-white shadow-lg overflow-hidden transition ease-out duration-200 transform origin-top-right",{"scale-100 opacity-100":h.value,"scale-95 opacity-0":!h.value}])},[e("ul",xe,[e("li",null,[e("button",{class:"block px-4 py-2 hover:bg-gray-100 w-full text-left text-sm",onClick:s[4]||(s[4]=t=>k("price_asc"))},"Price: Low to High")]),e("li",null,[e("button",{class:"block px-4 py-2 hover:bg-gray-100 w-full text-left text-sm",onClick:s[5]||(s[5]=t=>k("price_desc"))},"Price: High to Low")]),e("li",null,[e("button",{class:"block px-4 py-2 hover:bg-gray-100 w-full text-left text-sm",onClick:s[6]||(s[6]=t=>k("stock_asc"))},"Stock: Low to High")]),e("li",null,[e("button",{class:"block px-4 py-2 hover:bg-gray-100 w-full text-left text-sm",onClick:s[7]||(s[7]=t=>k("stock_desc"))},"Stock: High to Low")])])],2),[[F,h.value]])]),_:1})])]),e("div",ge,[o(i(x),{href:"/admin/products/create"},{default:m(()=>[e("button",pe,[o(i(X),{class:"-ml-0.5 h-5 w-5","aria-hidden":"true"}),f(" Add product ")])]),_:1})])]),e("div",be,[e("div",ye,[e("div",ve,[e("div",_e,[e("table",we,[ke,e("tbody",$e,[(a(!0),n(g,null,v(l.products.data,t=>(a(),n("tr",{key:t.id,class:"hover:bg-gray-100 focus-within:bg-gray-100"},[e("td",Ce,[o(i(x),{class:"flex justify-center items-center px-6 py-4",href:`/admin/products/${t.id}/edit`,tabindex:"-1"},{default:m(()=>[t.image_url?(a(),n("img",{key:0,src:t.image_url,alt:"Product Image",class:"w-20 h-20 object-cover rounded-full"},null,8,Se)):_("",!0)]),_:2},1032,["href"])]),e("td",je,[o(i(x),{class:"flex justify-center items-center px-6 py-4 focus:text-blue-500",href:`/admin/products/${t.id}/edit`},{default:m(()=>[f(u(t.name),1)]),_:2},1032,["href"])]),e("td",Ne,[e("div",Ee,[(a(!0),n(g,null,v(t.categoryNames,(c,d)=>(a(),n(g,null,[d<2||t.isCategoriesExpanded?(a(),n("span",{key:`category-${d}`,class:"bg-green-600 text-white rounded text-xs leading-4 py-1 px-2"},u(c),1)):_("",!0)],64))),256)),t.categoryNames.length>2?(a(),n("button",{key:0,onClick:c=>O(t),class:"text-xs text-blue-600 hover:underline"},u(t.isCategoriesExpanded?"Less":"More"),9,Pe)):_("",!0)])]),e("td",Te,[e("div",Be,[(a(!0),n(g,null,v(t.tagNames,(c,d)=>(a(),n(g,null,[d<2||t.isTagsExpanded?(a(),n("span",{key:`tag-${d}`,class:"bg-blue-600 text-white rounded-full text-xs leading-4 py-1 px-2"},u(c),1)):_("",!0)],64))),256)),t.tagNames.length>2?(a(),n("button",{key:0,onClick:c=>t.isTagsExpanded=!t.isTagsExpanded,class:"text-xs text-blue-600 hover:underline"},u(t.isTagsExpanded?"Less":"More"),9,Le)):_("",!0)])]),e("td",Ae,[o(i(x),{class:"flex justify-center items-center px-6 py-4",href:`/admin/products/${t.id}/edit`,tabindex:"-1"},{default:m(()=>[f(u(t.price),1)]),_:2},1032,["href"])]),e("td",He,[o(i(x),{class:"flex justify-center items-center px-6 py-4",href:`/admin/products/${t.id}/edit`,tabindex:"-1"},{default:m(()=>[f(u(t.stock),1)]),_:2},1032,["href"])]),e("td",Me,[e("div",Ve,[o(i(x),{class:"inline-flex items-center gap-x-2 rounded-md bg-green-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600",href:`/admin/products/${t.id}/edit`,tabindex:"-1"},{default:m(()=>[o(i(Y),{class:"-ml-0.5 h-5 w-5","aria-hidden":"true"})]),_:2},1032,["href"]),e("button",{type:"button",onClick:c=>D(t.id),class:"inline-flex items-center gap-x-2 rounded-md bg-red-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600"},[o(i(Z),{class:"-ml-0.5 h-5 w-5","aria-hidden":"true"})],8,De)])])]))),128))])]),e("div",Oe,[e("div",Ue,[f(" Showing "),e("span",Ie,u(l.products.from),1),f(" to "),e("span",ze,u(l.products.to),1),f(" of "),e("span",Fe,u(l.products.total),1),f(" results ")]),e("div",qe,[e("nav",Qe,[l.products.prev_page_url?(a(),n("a",{key:0,href:l.products.prev_page_url,class:"relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"},[o(i(A),{class:"h-5 w-5","aria-hidden":"true"}),Ge],8,Re)):(a(),n("a",Je,[o(i(A),{class:"h-5 w-5","aria-hidden":"true"}),Ke])),(a(!0),n(g,null,v(V(l.products.current_page,l.products.last_page),t=>(a(),n("a",{key:t,href:`?page=${t}`,class:B([{"bg-blue-600 text-white border-blue-600":t===l.products.current_page,"border-t border-b border-gray-300 text-gray-700 hover:bg-gray-50":t!==l.products.current_page,"border-r":t!==l.products.last_page},"relative inline-flex items-center px-4 py-2 text-sm font-medium"])},u(t),11,We))),128)),l.products.next_page_url?(a(),n("a",{key:2,href:l.products.next_page_url,class:"relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"},[o(i(j),{class:"h-5 w-5","aria-hidden":"true"}),Ye],8,Xe)):(a(),n("a",Ze,[o(i(j),{class:"h-5 w-5","aria-hidden":"true"}),et]))])])])])])])])])])]),_:1}))}};export{xt as default};