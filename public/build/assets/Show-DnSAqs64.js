import{o,c as w,w as a,a as e,t as n,b as r,u as i,g as _,y as k,e as l,h as m,F as g,j as x,n as f,i as p,f as S,O as y}from"./app-JsxQVuK5.js";import{A as C}from"./AppLayout-RL1yZ6o4.js";import{g as P,S as j,r as N,M as B,b as M}from"./ChevronDownIcon-BFJJcEZk.js";import{N as L,r as $}from"./StarIcon-BDbrgNQl.js";import"./FooterSection-B3qla_kT.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./ExclamationCircleIcon-Deok98lu.js";import"./Bars3Icon-CiW0Tf8T.js";import"./keyboard-B1eEn8PW.js";const V={class:"bg-white"},A={class:"pb-24"},F={class:"px-4 py-16 text-center sm:px-6 lg:px-8"},O={class:"text-4xl font-bold tracking-tight text-gray-900"},z={class:"mx-auto mt-4 max-w-xl text-base text-gray-500"},H=e("h2",{id:"filter-heading",class:"sr-only"},"Filters",-1),R={class:"col-start-1 row-start-1 py-4 border-b border-t border-gray-200"},T={class:"mx-auto flex max-w-7xl justify-end px-4 sm:px-6 lg:px-8"},D={class:"flex"},E={class:"py-1"},q=["onClick"],G={"aria-labelledby":"products-heading",class:"mx-auto max-w-7xl overflow-hidden sm:px-6 lg:px-8"},I=e("h2",{id:"products-heading",class:"sr-only"},"Products",-1),J={class:"border-b border-gray-200"},K={class:"-mx-px grid grid-cols-2 sm:mx-0 md:grid-cols-3 lg:grid-cols-4"},Q={class:"aspect-h-1 aspect-w-1 overflow-hidden rounded-lg bg-gray-200 duration-300 ease-in-out group-hover:scale-110"},U=["src","alt"],W={class:"pb-4 pt-10 text-center"},X={class:"text-sm font-medium text-gray-900"},Y=e("span",{"aria-hidden":"true",class:"absolute inset-0"},null,-1),Z={class:"mt-3 flex flex-col items-center"},ee={class:"sr-only"},te={class:"flex items-center"},se={class:"mt-1 text-sm text-gray-500"},re={class:"mt-4 text-base font-medium text-gray-900"},oe={"aria-label":"Pagination",class:"mx-auto mt-6 flex max-w-7xl justify-between px-4 text-sm font-medium text-gray-700 sm:px-6 lg:px-8"},ae={class:"min-w-0 flex-1"},ie=["aria-disabled"],ne={class:"hidden space-x-2 sm:flex"},le=["onClick"],ce={key:1,class:"inline-flex h-10 items-center px-1.5 text-gray-500"},de={class:"flex min-w-0 flex-1 justify-end"},ue=["aria-disabled"],we={__name:"Show",props:["category","products","siteSettings"],setup(s){const v=[{name:"Most Popular",order:"popularity_desc",current:!0},{name:"Best Rating",order:"rating_desc",current:!1},{name:"Newest",order:"newest_desc",current:!1},{name:"Price: Low to High",order:"price_asc",current:!1},{name:"Price: High to Low",order:"price_desc",current:!1}];function b(c){const d=new URL(window.location.href);d.searchParams.set("order",c),y.visit(d.toString(),{preserveState:!0,preserveScroll:!0})}function h(c){c&&y.visit(c,{preserveState:!0,preserveScroll:!0})}return(c,d)=>(o(),w(C,{siteSettings:s.siteSettings,title:s.category.name},{default:a(()=>[e("div",V,[e("main",A,[e("div",F,[e("h1",O,n(s.category.name),1),e("p",z,n(s.category.description),1)]),r(i(L),{as:"section","aria-labelledby":"filter-heading",class:"mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 items-center"},{default:a(()=>[H,e("div",R,[e("div",T,[r(i(P),{as:"div",class:"relative inline-block"},{default:a(()=>[e("div",D,[r(i(j),{class:"group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900"},{default:a(()=>[_(" Sort "),r(i(N),{class:"-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500","aria-hidden":"true"})]),_:1})]),r(k,{"enter-active-class":"transition ease-out duration-100","enter-from-class":"transform opacity-0 scale-95","enter-to-class":"transform opacity-100 scale-100","leave-active-class":"transition ease-in duration-75","leave-from-class":"transform opacity-100 scale-100","leave-to-class":"transform opacity-0 scale-95"},{default:a(()=>[r(i(B),{class:"absolute right-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none"},{default:a(()=>[e("div",E,[(o(),l(g,null,m(v,t=>r(i(M),{key:t.name},{default:a(({active:u})=>[e("a",{onClick:x(ge=>b(t.order),["prevent"]),class:f([t.current?"font-medium text-gray-900":"text-gray-500",u?"bg-gray-100":"","block px-4 py-2 text-sm"])},n(t.name),11,q)]),_:2},1024)),64))])]),_:1})]),_:1})]),_:1})])])]),_:1}),e("section",G,[I,e("div",J,[e("div",K,[(o(!0),l(g,null,m(s.products.data,t=>(o(),l("div",{key:t.id,class:"group relative p-4 sm:p-6"},[e("div",Q,[r(i(p),{href:c.route("products.show",t.slug)},{default:a(()=>[e("img",{src:t.image_url,alt:t.imageAlt,class:"h-full w-full object-cover object-center"},null,8,U)]),_:2},1032,["href"])]),e("div",W,[e("h3",X,[r(i(p),{href:c.route("products.show",t.slug)},{default:a(()=>[Y,_(" "+n(t.name),1)]),_:2},1032,["href"])]),e("div",Z,[e("p",ee,n(t.rating)+" out of 5 stars",1),e("div",te,[(o(),l(g,null,m([0,1,2,3,4],u=>r(i($),{key:u,class:f([t.average_rating>u?"text-yellow-400":"text-gray-300","h-5 w-5 flex-shrink-0"]),"aria-hidden":"true"},null,8,["class"])),64))]),e("p",se,n(t.total_reviews)+" reviews",1)]),e("p",re,n(t.price)+" €",1)])]))),128))])])]),e("nav",oe,[e("div",ae,[e("a",{onClick:d[0]||(d[0]=x(t=>h(s.products.prev_page_url),["prevent"])),class:f(["inline-flex h-10 items-center rounded-md border border-gray-300 bg-white px-4 hover:bg-gray-100 focus:border-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-opacity-25 focus:ring-offset-1 focus:ring-offset-indigo-600",{"cursor-not-allowed":!s.products.prev_page_url}]),"aria-disabled":!s.products.prev_page_url},"Previous",10,ie)]),e("div",ne,[(o(!0),l(g,null,m(s.products.last_page,t=>(o(),l(g,{key:t},[t==="..."||t===s.products.current_page||Math.abs(t-s.products.current_page)<3?(o(),l("a",{key:0,onClick:x(u=>h(t),["prevent"]),class:f([t===s.products.current_page?"border-indigo-600 ring-1 ring-indigo-600":"border-gray-300","inline-flex h-10 items-center rounded-md border bg-white px-4 hover:bg-gray-100 focus:border-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-opacity-25 focus:ring-offset-1 focus:ring-offset-indigo-600"])},n(t),11,le)):Math.abs(t-s.products.current_page)===3?(o(),l("span",ce,"...")):S("",!0)],64))),128))]),e("div",de,[e("a",{onClick:d[1]||(d[1]=x(t=>h(s.products.next_page_url),["prevent"])),class:f(["inline-flex h-10 items-center rounded-md border border-gray-300 bg-white px-4 hover:bg-gray-100 focus:border-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-opacity-25 focus:ring-offset-1 focus:ring-offset-indigo-600",{"cursor-not-allowed":!s.products.next_page_url}]),"aria-disabled":!s.products.next_page_url},"Next",10,ue)])])])])]),_:1},8,["siteSettings","title"]))}};export{we as default};
