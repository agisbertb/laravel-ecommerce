import{Y as D,d as _,p as G,q as H,o,c as u,w as l,a as e,b as a,u as t,e as n,h as g,F as m,g as I,y as q,k as w,I as k,t as h,j as E,n as A,i as J,O as K}from"./app-Cxyj-LO2.js";import{A as R}from"./AppLayout-BpxSKIEq.js";import{r as W}from"./micro-task-BXxnZ-Br.js";import{N as C,Q as $,V as S,r as X}from"./StarIcon-DjW3VrlH.js";import{r as j}from"./PlusIcon-CQqJZYAV.js";import{r as O,a as Z}from"./MinusIcon-BADYJQUy.js";import{S as ee,r as te,M as se,g as ae,b as le}from"./ChevronDownIcon-DUKbdmBo.js";import{Y as re,h as B,G as oe,S as ie}from"./transition-Dnr0CMhO.js";import"./FooterSection-BKfFZdQJ.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./ExclamationCircleIcon-0VQos8pm.js";import"./keyboard-DFV0bmR6.js";const ne={class:"bg-white"},de=e("div",{class:"fixed inset-0 bg-black bg-opacity-25"},null,-1),ce={class:"fixed inset-0 z-40 flex"},ue={class:"flex items-center justify-between px-4"},fe=e("h2",{class:"text-lg font-medium text-gray-900"},"Filters",-1),ge=e("span",{class:"sr-only"},"Close menu",-1),me={class:"mt-4 border-t border-gray-200"},he={class:"-mx-2 -my-3 flow-root"},pe=e("span",{class:"font-medium text-gray-900"},"Categories",-1),_e={class:"ml-6 flex items-center"},ye={class:"space-y-4"},xe=["id","value"],ve=["for"],be={class:"-mx-2 -my-3 flow-root"},we=e("span",{class:"font-medium text-gray-900"},"Tags",-1),ke={class:"ml-6 flex items-center"},Ce={class:"space-y-4"},$e=["id","value"],Se=["for"],je={class:"mx-auto max-w-7xl px-4 sm:px-6 lg:px-8"},Oe={class:"flex items-baseline justify-between border-b border-gray-200 pb-6 pt-24"},Fe=e("h1",{class:"text-4xl font-bold tracking-tight text-gray-900"},"All Categories",-1),Te={class:"flex items-center"},Ve={class:"py-1"},Ae=["onClick"],Be=e("span",{class:"sr-only"},"Filters",-1),Me={"aria-labelledby":"products-heading",class:"pb-24 pt-6"},Ne=e("h2",{id:"products-heading",class:"sr-only"},"Products",-1),ze={class:"grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4"},Le={class:"hidden lg:block"},Pe={class:"-my-3 flow-root"},Ue=e("span",{class:"font-medium text-gray-900"},"Categories",-1),Qe={class:"ml-6 flex items-center"},Ye={class:"space-y-4"},De=["id","value"],Ge=["for"],He={class:"-my-3 flow-root"},Ie=e("span",{class:"font-medium text-gray-900"},"Tags",-1),qe={class:"ml-6 flex items-center"},Ee={class:"space-y-4"},Je=["id","value"],Ke=["for"],Re={class:"lg:col-span-3"},We={class:"grid grid-cols-2 gap-6 sm:grid-cols-3 lg:grid-cols-4"},Xe={class:"aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-200 group-hover:opacity-75 duration-300 ease-in-out group-hover:scale-110"},Ze=["src","alt"],et={class:"mt-4 text-center"},tt={class:"text-sm font-medium text-gray-900"},st={class:"mt-2 flex items-center justify-center"},at={class:"flex items-center"},lt={class:"mt-4 text-base font-medium text-gray-900"},_t={__name:"Index",props:{siteSettings:Object},setup(M){const{products:N,categories:T,tags:V,selectedCategories:z,selectedTags:L,categoriesOpen:P,tagsOpen:U}=D().props,d=_(z||[]),c=_(L||[]),y=_(P),x=_(U),v=_(!1);G(()=>{y.value=d.value.length>0,x.value=c.value.length>0});const F=(p=null)=>{console.log("Fetching products with categories:",d.value,"and tags:",c.value),K.get(route("categories.index"),{categories:d.value,tags:c.value,order:p},{preserveState:!0,replace:!0,preserveScroll:!0,onSuccess:()=>{window.location.reload()}})};H([d,c],()=>{console.log("Filters changed."),F(),y.value=d.value.length>0,x.value=c.value.length>0});const b=()=>{console.log("Applying filters..."),F()},Q=[{name:"Newest",href:"#",order:"newest_desc",current:!0},{name:"Price: Low to High",href:"#",order:"price_asc",current:!1},{name:"Price: High to Low",href:"#",order:"price_desc",current:!1}],Y=p=>{console.log("Sorting by:",p),F(p)};return(p,i)=>(o(),u(R,{siteSettings:M.siteSettings,title:"All Categories"},{default:l(()=>[e("div",ne,[e("div",null,[a(t(ie),{as:"template",show:v.value},{default:l(()=>[a(t(re),{class:"relative z-40 lg:hidden",onClose:i[3]||(i[3]=r=>v.value=!1)},{default:l(()=>[a(t(B),{as:"template",enter:"transition-opacity ease-linear duration-300","enter-from":"opacity-0","enter-to":"opacity-100",leave:"transition-opacity ease-linear duration-300","leave-from":"opacity-100","leave-to":"opacity-0"},{default:l(()=>[de]),_:1}),e("div",ce,[a(t(B),{as:"template",enter:"transition ease-in-out duration-300 transform","enter-from":"translate-x-full","enter-to":"translate-x-0",leave:"transition ease-in-out duration-300 transform","leave-from":"translate-x-0","leave-to":"translate-x-full"},{default:l(()=>[a(t(oe),{class:"relative ml-auto flex h-full w-full max-w-xs flex-col overflow-y-auto bg-white py-4 pb-12 shadow-xl"},{default:l(()=>[e("div",ue,[fe,e("button",{type:"button",class:"-mr-2 flex h-10 w-10 items-center justify-center rounded-md bg-white p-2 text-gray-400",onClick:i[0]||(i[0]=r=>v.value=!1)},[ge,a(t(W),{class:"h-6 w-6","aria-hidden":"true"})])]),e("form",me,[a(t(C),{as:"div",class:"border-t border-gray-200 px-4 py-6","default-open":y.value},{default:l(({open:r})=>[e("h3",he,[a(t($),{class:"flex w-full items-center justify-between bg-white px-2 py-3 text-gray-400 hover:text-gray-500"},{default:l(()=>[pe,e("span",_e,[r?(o(),u(t(O),{key:1,class:"h-5 w-5","aria-hidden":"true"})):(o(),u(t(j),{key:0,class:"h-5 w-5","aria-hidden":"true"}))])]),_:2},1024)]),a(t(S),{class:"pt-6"},{default:l(()=>[e("div",ye,[(o(!0),n(m,null,g(t(T),s=>(o(),n("div",{key:s.id,class:"flex items-center"},[w(e("input",{id:`filter-category-${s.id}`,name:"categories[]",value:s.id,type:"checkbox",class:"h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500","onUpdate:modelValue":i[1]||(i[1]=f=>d.value=f),onChange:b},null,40,xe),[[k,d.value]]),e("label",{for:`filter-category-${s.id}`,class:"ml-3 text-sm text-gray-600"},h(s.name),9,ve)]))),128))])]),_:1})]),_:1},8,["default-open"]),a(t(C),{as:"div",class:"border-t border-gray-200 px-4 py-6","default-open":x.value},{default:l(({open:r})=>[e("h3",be,[a(t($),{class:"flex w-full items-center justify-between bg-white px-2 py-3 text-gray-400 hover:text-gray-500"},{default:l(()=>[we,e("span",ke,[r?(o(),u(t(O),{key:1,class:"h-5 w-5","aria-hidden":"true"})):(o(),u(t(j),{key:0,class:"h-5 w-5","aria-hidden":"true"}))])]),_:2},1024)]),a(t(S),{class:"pt-6"},{default:l(()=>[e("div",Ce,[(o(!0),n(m,null,g(t(V),s=>(o(),n("div",{key:s.id,class:"flex items-center"},[w(e("input",{id:`filter-tag-${s.id}`,name:"tags[]",value:s.id,type:"checkbox",class:"h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500","onUpdate:modelValue":i[2]||(i[2]=f=>c.value=f),onChange:b},null,40,$e),[[k,c.value]]),e("label",{for:`filter-tag-${s.id}`,class:"ml-3 text-sm text-gray-600"},h(s.name),9,Se)]))),128))])]),_:1})]),_:1},8,["default-open"])])]),_:1})]),_:1})])]),_:1})]),_:1},8,["show"]),e("main",je,[e("div",Oe,[Fe,e("div",Te,[a(t(ae),{as:"div",class:"relative inline-block text-left"},{default:l(()=>[e("div",null,[a(t(ee),{class:"group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900"},{default:l(()=>[I(" Sort "),a(t(te),{class:"-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500","aria-hidden":"true"})]),_:1})]),a(q,{"enter-active-class":"transition ease-out duration-100","enter-from-class":"transform opacity-0 scale-95","enter-to-class":"transform opacity-100 scale-100","leave-active-class":"transition ease-in duration-75","leave-from-class":"transform opacity-100 scale-100","leave-to-class":"transform scale-95 opacity-0"},{default:l(()=>[a(t(se),{class:"absolute right-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none"},{default:l(()=>[e("div",Ve,[(o(),n(m,null,g(Q,r=>a(t(le),{key:r.name},{default:l(({active:s})=>[e("a",{onClick:E(f=>Y(r.order),["prevent"]),class:A([r.current?"font-medium text-gray-900":"text-gray-500",s?"bg-gray-100":"","block px-4 py-2 text-sm"])},h(r.name),11,Ae)]),_:2},1024)),64))])]),_:1})]),_:1})]),_:1}),e("button",{type:"button",class:"-m-2 ml-4 p-2 text-gray-400 hover:text-gray-500 sm:ml-6 lg:hidden",onClick:i[4]||(i[4]=r=>v.value=!0)},[Be,a(t(Z),{class:"h-5 w-5","aria-hidden":"true"})])])]),e("section",Me,[Ne,e("div",ze,[e("form",Le,[a(t(C),{as:"div",class:"border-b border-gray-200 py-6","default-open":y.value},{default:l(({open:r})=>[e("h3",Pe,[a(t($),{class:"flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500"},{default:l(()=>[Ue,e("span",Qe,[r?(o(),u(t(O),{key:1,class:"h-5 w-5","aria-hidden":"true"})):(o(),u(t(j),{key:0,class:"h-5 w-5","aria-hidden":"true"}))])]),_:2},1024)]),a(t(S),{class:"pt-6"},{default:l(()=>[e("div",Ye,[(o(!0),n(m,null,g(t(T),s=>(o(),n("div",{key:s.id,class:"flex items-center"},[w(e("input",{id:`filter-category-${s.id}`,name:"categories[]",value:s.id,type:"checkbox",class:"h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500","onUpdate:modelValue":i[5]||(i[5]=f=>d.value=f),onChange:b},null,40,De),[[k,d.value]]),e("label",{for:`filter-category-${s.id}`,class:"ml-3 text-sm text-gray-600"},h(s.name),9,Ge)]))),128))])]),_:1})]),_:1},8,["default-open"]),a(t(C),{as:"div",class:"border-b border-gray-200 py-6","default-open":x.value},{default:l(({open:r})=>[e("h3",He,[a(t($),{class:"flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500"},{default:l(()=>[Ie,e("span",qe,[r?(o(),u(t(O),{key:1,class:"h-5 w-5","aria-hidden":"true"})):(o(),u(t(j),{key:0,class:"h-5 w-5","aria-hidden":"true"}))])]),_:2},1024)]),a(t(S),{class:"pt-6"},{default:l(()=>[e("div",Ee,[(o(!0),n(m,null,g(t(V),s=>(o(),n("div",{key:s.id,class:"flex items-center"},[w(e("input",{id:`filter-tag-${s.id}`,name:"tags[]",value:s.id,type:"checkbox",class:"h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500","onUpdate:modelValue":i[6]||(i[6]=f=>c.value=f),onChange:b},null,40,Je),[[k,c.value]]),e("label",{for:`filter-tag-${s.id}`,class:"ml-3 text-sm text-gray-600"},h(s.name),9,Ke)]))),128))])]),_:1})]),_:1},8,["default-open"])]),e("div",Re,[e("div",We,[(o(!0),n(m,null,g(t(N),r=>(o(),n("div",{key:r.id,class:"group relative"},[a(t(J),{href:p.route("products.show",r.slug),class:"block"},{default:l(()=>[e("div",Xe,[e("img",{src:r.image_url,alt:r.name,class:"h-full w-full object-cover object-center"},null,8,Ze)]),e("div",et,[e("h3",tt,h(r.name),1),e("div",st,[e("div",at,[(o(),n(m,null,g([0,1,2,3,4],s=>a(t(X),{key:s,class:A([r.average_rating>s?"text-yellow-400":"text-gray-200","h-5 w-5 flex-shrink-0"]),"aria-hidden":"true"},null,8,["class"])),64))])]),e("p",lt,h(r.price)+" €",1)])]),_:2},1032,["href"])]))),128))])])])])])])])]),_:1},8,["siteSettings"]))}};export{_t as default};
