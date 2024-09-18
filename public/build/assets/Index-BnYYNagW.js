import{_ as g}from"./ProfileLayout-Dx4qE_-S.js";import{o,c as h,w as r,a as e,e as i,h as f,F as u,t as a,b as c,u as n,i as d,g as m}from"./app-JsxQVuK5.js";import"./AppLayout-RL1yZ6o4.js";import"./FooterSection-B3qla_kT.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./ExclamationCircleIcon-Deok98lu.js";import"./Bars3Icon-CiW0Tf8T.js";import"./UserIcon-C5xJ_kCf.js";import"./HomeIcon-CX7JyigJ.js";const _={class:"bg-white"},x={class:"max-w-7xl mx-auto sm:px-6 lg:px-8"},p=e("h1",{class:"text-3xl font-bold tracking-tight text-gray-900"},"Your Orders",-1),y=e("p",{class:"mt-2 text-sm text-gray-500"},"Check the status of recent orders, manage returns, and discover similar products.",-1),b={class:"mt-12 space-y-16 sm:mt-16"},w=["aria-labelledby"],v={class:"space-y-1 md:flex md:items-baseline md:space-x-4 md:space-y-0"},k=["id"],S={class:"space-y-5 sm:flex sm:items-baseline sm:justify-between sm:space-y-0 md:min-w-0 md:flex-1"},j={class:"text-sm font-medium text-gray-500"},B={class:"-mb-6 mt-6 flow-root divide-y divide-gray-200 border-t border-gray-200"},C={class:"flex space-x-4 sm:min-w-0 sm:flex-1 sm:space-x-6 lg:space-x-8"},D=["src","alt"],N={class:"min-w-0 flex-1 pt-1.5 sm:pt-0"},O={class:"text-sm font-medium text-gray-900"},V={class:"mt-1 font-medium text-gray-900"},$={class:"mt-6 space-y-4 sm:ml-6 sm:mt-0 sm:w-40 sm:flex-none"},J={__name:"Index",props:{orders:Array,siteSettings:Object},setup(l){return(F,L)=>(o(),h(g,{siteSettings:l.siteSettings},{default:r(()=>[e("div",_,[e("div",x,[p,y,e("div",b,[(o(!0),i(u,null,f(l.orders,s=>(o(),i("section",{key:s.id,"aria-labelledby":`${s.id}-heading`},[e("div",v,[e("h2",{id:`${s.id}-heading`,class:"text-lg font-medium text-gray-900 md:flex-shrink-0"},"Order #"+a(s.id),9,k),e("div",S,[e("p",j,"Created at "+a(new Date(s.created_at).toLocaleDateString()),1)])]),e("div",B,[(o(!0),i(u,null,f(s.details,t=>(o(),i("div",{key:t.id,class:"py-6 sm:flex"},[e("div",C,[e("img",{src:t.product.image_url,alt:t.product.name,class:"h-20 w-20 flex-none rounded-md object-cover object-center sm:h-48 sm:w-48"},null,8,D),e("div",N,[e("h3",O,[c(n(d),{href:t.product.href},{default:r(()=>[m(a(t.product.name),1)]),_:2},1032,["href"])]),e("p",V,a(t.price)+" €",1)])]),e("div",$,[c(n(d),{href:t.product.href,class:"flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-2.5 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-full sm:flex-grow-0"},{default:r(()=>[m("Buy again")]),_:2},1032,["href"]),c(n(d),{href:t.product.categoryHref,class:"flex w-full items-center justify-center rounded-md border border-gray-300 bg-white px-2.5 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-full sm:flex-grow-0"},{default:r(()=>[m("Shop similar")]),_:2},1032,["href"])])]))),128))])],8,w))),128))])])])]),_:1},8,["siteSettings"]))}};export{J as default};