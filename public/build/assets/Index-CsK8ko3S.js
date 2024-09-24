import{d as b,p as z,s as E,q as A,o as n,c as F,w as m,a as e,b as a,u as o,i as v,e as l,h as w,F as k,k as $,v as C,g as d,x as L,n as D,y as Z,t as f,O as T}from"./app-Cxyj-LO2.js";import{_ as q,r as H}from"./AdminLayout-DzAcwDTt.js";import{_ as I}from"./AlertNotification-D5CAYTCq.js";import{r as Q,a as S}from"./HomeIcon-BaBBpbdS.js";import{r as R,a as O}from"./ChevronLeftIcon-_UR9GOBL.js";import{r as G}from"./ChevronDownIcon-DUKbdmBo.js";import{r as J}from"./PlusIcon-CQqJZYAV.js";import{r as K}from"./PencilSquareIcon-DqpRFWyz.js";import{r as W}from"./TrashIcon-BUxSh_lh.js";import"./HomeIcon-D3-R6IGz.js";import"./transition-Dnr0CMhO.js";import"./keyboard-DFV0bmR6.js";import"./micro-task-BXxnZ-Br.js";import"./ExclamationCircleIcon-0VQos8pm.js";const X={class:"mx-4 mt-4 mb-14"},Y={class:"flex","aria-label":"Breadcrumb"},ee={role:"list",class:"flex items-center space-x-4"},te=e("span",{class:"sr-only"},"Home",-1),se={class:"flex items-center"},ae=["href","aria-current"],re={class:"mt-4 mx-4"},oe={class:"bg-white p-6 rounded-2xl border-b shadow-2xl"},ie={class:"sm:flex sm:items-center sm:justify-between"},ne={class:"relative inline-block text-left"},le=e("label",{for:"mobile-search-candidate",class:"sr-only"},"Search",-1),de=e("label",{for:"desktop-search-candidate",class:"sr-only"},"Search",-1),ce={class:"flex rounded-md shadow-sm"},ue={class:"relative flex-grow focus-within:z-10"},me={class:"pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"},fe={class:"text-gray-700"},he={class:"mt-4 sm:mt-0 sm:ml-16 sm:flex sm:flex-row-reverse"},ge={type:"button",class:"inline-flex items-center gap-x-2 rounded-md bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"},xe={class:"mt-8 flow-root"},be={class:"-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8"},ve={class:"inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8"},pe={class:"overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg"},ye={class:"min-w-full divide-y divide-gray-300"},_e=e("thead",{class:"bg-gray-100"},[e("tr",null,[e("th",{scope:"col",class:"px-3 py-3.5 text-sm font-semibold text-center text-gray-900"}," Name"),e("th",{scope:"col",class:"px-3 py-3.5 text-sm font-semibold text-center text-gray-900"}," Description"),e("th",{scope:"col",class:"px-3 py-3.5 text-sm font-semibold text-center text-gray-900"}," Action")])],-1),we={class:"divide-y divide-gray-200 bg-white"},ke={class:"border-t"},$e={class:"border-t"},Se={class:"border-t"},Be={class:"flex justify-center space-x-4"},Ne=["onClick"],je={class:"flex items-center border-t border-gray-200 bg-white px-4 py-3 sm:px-6"},Ae={class:"text-sm text-gray-700"},Ce={class:"font-medium"},De={class:"font-medium"},Te={class:"font-medium"},Oe={class:"flex justify-end flex-grow"},Ue={class:"inline-flex rounded-md shadow-sm","aria-label":"Pagination"},Ve=["href"],Me=e("span",{class:"sr-only"},"Previous",-1),Pe={key:1,class:"relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-300"},ze=e("span",{class:"sr-only"},"Previous",-1),Ee=["href"],Fe=["href"],Le=e("span",{class:"sr-only"},"Next",-1),Ze={key:3,class:"relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-300"},qe=e("span",{class:"sr-only"},"Next",-1),rt={__name:"Index",props:{tags:Object,flash:Object},setup(i){const p=i,U=[{name:"Admin",href:"/admin/dashboard",current:!1},{name:"tags",href:"/admin/tags",current:!0}],c=b(!1),B=b(""),h=b(""),g=b(!1),y=b(""),V=r=>{!r.target.closest(".dropdown-button")&&!r.target.closest(".dropdown-menu")&&(c.value=!1)};z(()=>{p.flash&&p.flash.success&&(y.value=p.flash.success,g.value=!0,setTimeout(()=>{g.value=!1},5e3))}),E(()=>{window.removeEventListener("click",V)}),A(h,r=>{N(r)}),A(()=>p.flash.success,r=>{r&&(y.value=r,g.value=!0,setTimeout(()=>{g.value=!1},5e3))},{immediate:!0});const M=(r,s)=>{let t=r-1,x=r+1;const u=[];t<1&&(t=1),x>s&&(x=s);for(let _=t;_<=x;_++)u.push(_);return t>2&&(u.unshift("..."),u.unshift(1)),x<s-1?(u.push("..."),u.push(s)):x===s-1&&u.push(s),u};function N(r,s=B.value){T.get("/admin/tags",{search:r,order:s},{preserveState:!0,replace:!0,preserveScroll:!0})}function j(r){B.value=r,N(h.value,r),c.value=!1}function P(r){confirm("Are you sure you want to delete this tag?")&&T.delete(`/admin/tags/${r}`)}return(r,s)=>(n(),F(q,{title:"tags"},{default:m(()=>[e("div",X,[e("nav",Y,[e("ol",ee,[e("li",null,[e("div",null,[a(o(v),{href:"/admin/dashboard",class:"text-gray-400 hover:text-gray-500"},{default:m(()=>[a(o(Q),{class:"h-5 w-5 flex-shrink-0","aria-hidden":"true"}),te]),_:1})])]),(n(),l(k,null,w(U,t=>e("li",{key:t.name},[e("div",se,[a(o(S),{class:"h-5 w-5 flex-shrink-0 text-gray-400","aria-hidden":"true"}),e("a",{href:t.href,class:"ml-4 text-sm font-medium text-gray-500 hover:text-gray-700","aria-current":t.current?"page":void 0},f(t.name),9,ae)])])),64))])])]),a(I,{title:"Success",message:y.value,visible:g.value,"onUpdate:visible":s[0]||(s[0]=t=>g.value=t)},null,8,["message","visible"]),e("div",re,[e("div",oe,[e("div",ie,[e("div",ne,[le,de,e("div",ce,[e("div",ue,[e("div",me,[a(o(H),{class:"h-5 w-5 text-gray-400","aria-hidden":"true"})]),$(e("input",{"onUpdate:modelValue":s[1]||(s[1]=t=>h.value=t),id:"mobile-search-candidate",name:"search",type:"search",class:"block w-full rounded-none rounded-l-md border-0 py-1.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:hidden",placeholder:"Search"},null,512),[[C,h.value]]),$(e("input",{"onUpdate:modelValue":s[2]||(s[2]=t=>h.value=t),id:"desktop-search-candidate",name:"search-mobile",type:"search",class:"hidden w-full rounded-none rounded-l-md border-0 py-1.5 pl-10 text-sm leading-6 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:block",placeholder:"Search tags"},null,512),[[C,h.value]])]),e("button",{onClick:s[3]||(s[3]=t=>c.value=!c.value),type:"button",class:"dropdown-button relative -ml-px inline-flex items-center gap-x-1.5 rounded-r-md px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50"},[a(o(R),{class:"-ml-0.5 h-5 w-5 text-gray-400","aria-hidden":"true"}),d(" Sort "),a(o(G),{class:"-mr-1 h-5 w-5 text-gray-400","aria-hidden":"true"})]),a(Z,{name:"dropdown","enter-active-class":"transition ease-out duration-200","enter-from-class":"transform scale-95 opacity-0","enter-to-class":"transform scale-100 opacity-100","leave-active-class":"transition ease-in duration-150","leave-from-class":"transform scale-100 opacity-100","leave-to-class":"transform scale-95 opacity-0"},{default:m(()=>[$(e("div",{class:D(["dropdown-menu absolute right-0 top-full mt-1 rounded-md bg-white shadow-lg overflow-hidden transition ease-out duration-200 transform origin-top-right",{"scale-100 opacity-100":c.value,"scale-95 opacity-0":!c.value}])},[e("ul",fe,[e("li",null,[e("button",{class:"block px-4 py-2 hover:bg-gray-100 w-full text-left text-sm",onClick:s[4]||(s[4]=t=>j("name_asc"))},"Name: A to Z")]),e("li",null,[e("button",{class:"block px-4 py-2 hover:bg-gray-100 w-full text-left text-sm",onClick:s[5]||(s[5]=t=>j("name_desc"))},"Name: Z to A")])])],2),[[L,c.value]])]),_:1})])]),e("div",he,[a(o(v),{href:"/admin/tags/create"},{default:m(()=>[e("button",ge,[a(o(J),{class:"-ml-0.5 h-5 w-5","aria-hidden":"true"}),d(" Add tag ")])]),_:1})])]),e("div",xe,[e("div",be,[e("div",ve,[e("div",pe,[e("table",ye,[_e,e("tbody",we,[(n(!0),l(k,null,w(i.tags.data,t=>(n(),l("tr",{key:t.id,class:"hover:bg-gray-100 focus-within:bg-gray-100"},[e("td",ke,[a(o(v),{class:"flex justify-center items-center px-6 py-4",href:`/admin/tags/${t.id}/edit`,tabindex:"-1"},{default:m(()=>[d(f(t.name),1)]),_:2},1032,["href"])]),e("td",$e,[a(o(v),{class:"flex justify-center items-center px-6 py-4 focus:text-blue-500",href:`/admin/tags/${t.id}/edit`},{default:m(()=>[d(f(t.description),1)]),_:2},1032,["href"])]),e("td",Se,[e("div",Be,[a(o(v),{class:"inline-flex items-center gap-x-2 rounded-md bg-green-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600",href:`/admin/tags/${t.id}/edit`,tabindex:"-1"},{default:m(()=>[a(o(K),{class:"-ml-0.5 h-5 w-5","aria-hidden":"true"})]),_:2},1032,["href"]),e("button",{type:"button",onClick:x=>P(t.id),class:"inline-flex items-center gap-x-2 rounded-md bg-red-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600"},[a(o(W),{class:"-ml-0.5 h-5 w-5","aria-hidden":"true"})],8,Ne)])])]))),128))])]),e("div",je,[e("div",Ae,[d(" Showing "),e("span",Ce,f(i.tags.from),1),d(" to "),e("span",De,f(i.tags.to),1),d(" of "),e("span",Te,f(i.tags.total),1),d(" results ")]),e("div",Oe,[e("nav",Ue,[i.tags.prev_page_url?(n(),l("a",{key:0,href:i.tags.prev_page_url,class:"relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"},[a(o(O),{class:"h-5 w-5","aria-hidden":"true"}),Me],8,Ve)):(n(),l("a",Pe,[a(o(O),{class:"h-5 w-5","aria-hidden":"true"}),ze])),(n(!0),l(k,null,w(M(i.tags.current_page,i.tags.last_page),t=>(n(),l("a",{key:t,href:`?page=${t}`,class:D([{"bg-blue-600 text-white border-blue-600":t===i.tags.current_page,"border-t border-b border-gray-300 text-gray-700 hover:bg-gray-50":t!==i.tags.current_page,"border-r":t!==i.tags.last_page},"relative inline-flex items-center px-4 py-2 text-sm font-medium"])},f(t),11,Ee))),128)),i.tags.next_page_url?(n(),l("a",{key:2,href:i.tags.next_page_url,class:"relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"},[a(o(S),{class:"h-5 w-5","aria-hidden":"true"}),Le],8,Fe)):(n(),l("a",Ze,[a(o(S),{class:"h-5 w-5","aria-hidden":"true"}),qe]))])])])])])])])])])]),_:1}))}};export{rt as default};
